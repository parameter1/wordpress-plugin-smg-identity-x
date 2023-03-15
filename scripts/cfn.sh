#!/bin/zsh
set -e

REGION="$AWS_REGION"
if [ -z "$REGION"]; then
  REGION="us-east-2"
fi

usage() {
  printf "\nUsage: $0 <create|update|delete> <tenant> <production|staging|development>\n"
  printf "This script requires the AWS CLI with \`idx-icle-<tenant>-<environment>\` profiles configured!\n"
  exit 1
}

[[ -z "$2" ]] && usage
STACK_NAME="event-queues"
TEMPLATE_BODY=$(cat .aws/cfn-event-queues.template | jq . -c)

case "$2" in
  drb)
    TENANT="drb"
    ;;
  *)
    usage
esac

case "$3" in
  production)
    ENV="production"
    ;;
  staging)
    ENV="staging"
    ;;
  development)
    ENV="development"
    ;;
  *)
    usage
esac


createBucket() {
  set +e
  echo "Creating S3 Bucket..."
  aws --profile idx-icle-$TENANT-$ENV s3api create-bucket \
    --bucket p1cfn-idx-icle-$TENANT-$ENV \
    --create-bucket-configuration LocationConstraint=$REGION
  set -e
}
deleteBucket() {
  echo "Deleting S3 Bucket..."
  aws --profile idx-icle-$TENANT-$ENV s3 rm s3://p1cfn-idx-icle-$TENANT-$ENV --recursive
  aws --profile idx-icle-$TENANT-$ENV s3api delete-bucket \
    --bucket p1cfn-idx-icle-$TENANT-$ENV
}

updateTemplates() {
  aws --profile idx-icle-$TENANT-$ENV s3 sync \
    .aws s3://p1cfn-idx-icle-$TENANT-$ENV/
}

deleteStack() {
  echo "Deleting $STACK_NAME CloudFormation stack..."
  aws --profile idx-icle-$TENANT-$ENV cloudformation delete-stack \
    --stack-name $STACK_NAME \
    --region $REGION
  echo "Waiting for the stack to be deleted, this may take a few minutes..."
  aws --profile idx-icle-$TENANT-$ENV cloudformation wait stack-delete-complete \
    --stack-name $STACK_NAME \
    --region $REGION
}
createStack() {
  echo "Creating $STACK_NAME CloudFormation stack..."
  aws --profile idx-icle-$TENANT-$ENV cloudformation create-stack \
    --stack-name $STACK_NAME --region $REGION --template-body $TEMPLATE_BODY
  set +e
  echo "Waiting for the stack to be created, this may take a few minutes..."
  echo "See the progress at: https://$REGION.console.aws.amazon.com/cloudformation/home?region=$REGION#/stacks"
  aws --profile idx-icle-$TENANT-$ENV cloudformation wait stack-create-complete \
    --stack-name $STACK_NAME  --region $REGION
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
  aws --profile idx-icle-$TENANT-$ENV cloudformation update-stack \
    --stack-name $STACK_NAME --region $REGION --template-body $TEMPLATE_BODY
  echo "Waiting for the stack to be updated, this may take a few minutes..."
  echo "See the progress at: https://$REGION.console.aws.amazon.com/cloudformation/home?region=$REGION#/stacks"
  aws --profile idx-icle-$TENANT-$ENV cloudformation wait stack-update-complete \
    --stack-name $STACK_NAME --region $REGION
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
