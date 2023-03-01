#!/bin/bash
set -e

REGION="$AWS_REGION"
if [ -z "$REGION"]; then
  REGION="us-east-2"
fi

usage() {
  printf "\nUsage: $0 <create|update|delete> <stack-name>\n"
  printf "This script requires the AWS CLI with an \`wordpress-identityx\` profile configured!\n"
  exit 1
}

[[ -z "$2" ]] && usage
STACK_NAME="$2"


createBucket() {
  set +e
  echo "Creating S3 Bucket..."
  aws --profile wordpress-identityx s3api create-bucket \
    --bucket p1cfn-wordpress-identityx \
    --create-bucket-configuration LocationConstraint=$REGION
  set -e
}
deleteBucket() {
  echo "Deleting S3 Bucket..."
  aws --profile wordpress-identityx s3 rm s3://p1cfn-wordpress-identityx --recursive
  aws --profile wordpress-identityx s3api delete-bucket \
    --bucket p1cfn-wordpress-identityx
}

updateTemplates() {
  aws --profile wordpress-identityx s3 sync \
    .aws s3://p1cfn-wordpress-identityx/
}

deleteStack() {
  echo "Deleting $STACK_NAME CloudFormation stack..."
  aws --profile wordpress-identityx cloudformation delete-stack \
    --stack-name $STACK_NAME \
    --region $REGION
  echo "Waiting for the stack to be deleted, this may take a few minutes..."
  aws --profile wordpress-identityx cloudformation wait stack-delete-complete \
    --stack-name $STACK_NAME \
    --region $REGION
}
createStack() {
  echo "Creating $STACK_NAME CloudFormation stack..."
  aws --profile wordpress-identityx cloudformation create-stack \
    --stack-name $STACK_NAME \
    --region $REGION \
    --template-url https://s3.$REGION.amazonaws.com/p1cfn-wordpress-identityx/cfn-$STACK_NAME.template \
    --capabilities CAPABILITY_NAMED_IAM
  set +e
  echo "Waiting for the stack to be created, this may take a few minutes..."
  echo "See the progress at: https://$REGION.console.aws.amazon.com/cloudformation/home?region=$REGION#/stacks"
  aws --profile wordpress-identityx cloudformation wait stack-create-complete \
    --stack-name $STACK_NAME \
    --region $REGION
  RESULT=$(echo $?)
  set -e
  if [ $RESULT -ne 0 ]; then
    echo "The creation process has failed."
    deleteStack
    exit 1
  fi
}
updateStack() {
  echo "Updating $STACK_NAME CloudFormation stack..."
  aws --profile wordpress-identityx cloudformation update-stack \
    --stack-name $STACK_NAME \
    --region $REGION \
    --template-url https://s3.$REGION.amazonaws.com/p1cfn-wordpress-identityx/cfn-$STACK_NAME.template \
    --capabilities CAPABILITY_NAMED_IAM
  echo "Waiting for the stack to be updated, this may take a few minutes..."
  echo "See the progress at: https://$REGION.console.aws.amazon.com/cloudformation/home?region=$REGION#/stacks"
  aws --profile wordpress-identityx cloudformation wait stack-update-complete \
    --stack-name $STACK_NAME \
    --region $REGION
}

case "$1" in
  create)
    createBucket
    updateTemplates
    createStack
    ;;
  delete)
    deleteStack
    deleteBucket
    ;;
  update)
    updateTemplates
    updateStack
    ;;
  *)
    usage
esac
