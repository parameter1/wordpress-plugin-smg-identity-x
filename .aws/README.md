# AWS setup
1. set up an AWS cli profile matching the pattern
```ini
[idx-icle-<TENANT>-<ENV>]
; The role to assume
role_arn=arn:aws:iam::<AWS_ACCOUNT_ID>:role/OrganizationAccountAccessRole
; The source profile to assume from (where you are authenticated)
source_profile=parameter1
```

2. Execute the cloudformation script to start up infra:
```sh
./scripts/cfn.sh create <TENANT> <ENVIRONMENT>
```

3. Access the CFN outputs to obtain SQS queue and API Gateway URLs, and IAM credentials. Access the Api key from the resources tab.
4. Install plugin as must-use (mu-plugins/ folder)
5. Configure plugin (Settings > IdentityX) with the SQS, IAM, and API Gateway credentials.
6. (Re-)generate an IdentityX API read token for the service worker (josh+wpicle-read@parameter1.com) and configure in plugin settings.
7. Set API Key and processor envs on generated lambda functions:
```
// in idx function
PROCESSOR_API_KEY=<key-from-api-gateway>
PROCESSOR_ENDPOINT=https://<environment-site-domain>/api/update-identityx-users

// in wp function
PROCESSOR_API_KEY=<key-from-api-gateway>
PROCESSOR_ENDPOINT=https://<environment-wordpress-domain>/api/identity-x/ingest
```
8. Configure site (config/wp-icle.js) with SQS, IAM, and Api Key credentials
