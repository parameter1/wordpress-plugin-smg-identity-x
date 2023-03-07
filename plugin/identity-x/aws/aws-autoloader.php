<?php

$mapping = array(
    'Aws\AbstractConfigurationProvider' => __DIR__ . '/Aws/AbstractConfigurationProvider.php',
    'Aws\Api\AbstractModel' => __DIR__ . '/Aws/Api/AbstractModel.php',
    'Aws\Api\ApiProvider' => __DIR__ . '/Aws/Api/ApiProvider.php',
    'Aws\Api\DateTimeResult' => __DIR__ . '/Aws/Api/DateTimeResult.php',
    'Aws\Api\DocModel' => __DIR__ . '/Aws/Api/DocModel.php',
    'Aws\Api\ErrorParser\AbstractErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/AbstractErrorParser.php',
    'Aws\Api\ErrorParser\JsonParserTrait' => __DIR__ . '/Aws/Api/ErrorParser/JsonParserTrait.php',
    'Aws\Api\ErrorParser\JsonRpcErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/JsonRpcErrorParser.php',
    'Aws\Api\ErrorParser\RestJsonErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/RestJsonErrorParser.php',
    'Aws\Api\ErrorParser\XmlErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/XmlErrorParser.php',
    'Aws\Api\ListShape' => __DIR__ . '/Aws/Api/ListShape.php',
    'Aws\Api\MapShape' => __DIR__ . '/Aws/Api/MapShape.php',
    'Aws\Api\Operation' => __DIR__ . '/Aws/Api/Operation.php',
    'Aws\Api\Parser\AbstractParser' => __DIR__ . '/Aws/Api/Parser/AbstractParser.php',
    'Aws\Api\Parser\AbstractRestParser' => __DIR__ . '/Aws/Api/Parser/AbstractRestParser.php',
    'Aws\Api\Parser\Crc32ValidatingParser' => __DIR__ . '/Aws/Api/Parser/Crc32ValidatingParser.php',
    'Aws\Api\Parser\DecodingEventStreamIterator' => __DIR__ . '/Aws/Api/Parser/DecodingEventStreamIterator.php',
    'Aws\Api\Parser\EventParsingIterator' => __DIR__ . '/Aws/Api/Parser/EventParsingIterator.php',
    'Aws\Api\Parser\Exception\ParserException' => __DIR__ . '/Aws/Api/Parser/Exception/ParserException.php',
    'Aws\Api\Parser\JsonParser' => __DIR__ . '/Aws/Api/Parser/JsonParser.php',
    'Aws\Api\Parser\JsonRpcParser' => __DIR__ . '/Aws/Api/Parser/JsonRpcParser.php',
    'Aws\Api\Parser\MetadataParserTrait' => __DIR__ . '/Aws/Api/Parser/MetadataParserTrait.php',
    'Aws\Api\Parser\PayloadParserTrait' => __DIR__ . '/Aws/Api/Parser/PayloadParserTrait.php',
    'Aws\Api\Parser\QueryParser' => __DIR__ . '/Aws/Api/Parser/QueryParser.php',
    'Aws\Api\Parser\RestJsonParser' => __DIR__ . '/Aws/Api/Parser/RestJsonParser.php',
    'Aws\Api\Parser\RestXmlParser' => __DIR__ . '/Aws/Api/Parser/RestXmlParser.php',
    'Aws\Api\Parser\XmlParser' => __DIR__ . '/Aws/Api/Parser/XmlParser.php',
    'Aws\Api\Serializer\Ec2ParamBuilder' => __DIR__ . '/Aws/Api/Serializer/Ec2ParamBuilder.php',
    'Aws\Api\Serializer\JsonBody' => __DIR__ . '/Aws/Api/Serializer/JsonBody.php',
    'Aws\Api\Serializer\JsonRpcSerializer' => __DIR__ . '/Aws/Api/Serializer/JsonRpcSerializer.php',
    'Aws\Api\Serializer\QueryParamBuilder' => __DIR__ . '/Aws/Api/Serializer/QueryParamBuilder.php',
    'Aws\Api\Serializer\QuerySerializer' => __DIR__ . '/Aws/Api/Serializer/QuerySerializer.php',
    'Aws\Api\Serializer\RestJsonSerializer' => __DIR__ . '/Aws/Api/Serializer/RestJsonSerializer.php',
    'Aws\Api\Serializer\RestSerializer' => __DIR__ . '/Aws/Api/Serializer/RestSerializer.php',
    'Aws\Api\Serializer\RestXmlSerializer' => __DIR__ . '/Aws/Api/Serializer/RestXmlSerializer.php',
    'Aws\Api\Serializer\XmlBody' => __DIR__ . '/Aws/Api/Serializer/XmlBody.php',
    'Aws\Api\Service' => __DIR__ . '/Aws/Api/Service.php',
    'Aws\Api\Shape' => __DIR__ . '/Aws/Api/Shape.php',
    'Aws\Api\ShapeMap' => __DIR__ . '/Aws/Api/ShapeMap.php',
    'Aws\Api\StructureShape' => __DIR__ . '/Aws/Api/StructureShape.php',
    'Aws\Api\TimestampShape' => __DIR__ . '/Aws/Api/TimestampShape.php',
    'Aws\Api\Validator' => __DIR__ . '/Aws/Api/Validator.php',
    'Aws\Arn\AccessPointArn' => __DIR__ . '/Aws/Arn/AccessPointArn.php',
    'Aws\Arn\AccessPointArnInterface' => __DIR__ . '/Aws/Arn/AccessPointArnInterface.php',
    'Aws\Arn\Arn' => __DIR__ . '/Aws/Arn/Arn.php',
    'Aws\Arn\ArnInterface' => __DIR__ . '/Aws/Arn/ArnInterface.php',
    'Aws\Arn\ArnParser' => __DIR__ . '/Aws/Arn/ArnParser.php',
    'Aws\Arn\Exception\InvalidArnException' => __DIR__ . '/Aws/Arn/Exception/InvalidArnException.php',
    'Aws\Arn\ObjectLambdaAccessPointArn' => __DIR__ . '/Aws/Arn/ObjectLambdaAccessPointArn.php',
    'Aws\Arn\ResourceTypeAndIdTrait' => __DIR__ . '/Aws/Arn/ResourceTypeAndIdTrait.php',
    'Aws\Arn\S3\AccessPointArn' => __DIR__ . '/Aws/Arn/S3/AccessPointArn.php',
    'Aws\Arn\S3\BucketArnInterface' => __DIR__ . '/Aws/Arn/S3/BucketArnInterface.php',
    'Aws\Arn\S3\MultiRegionAccessPointArn' => __DIR__ . '/Aws/Arn/S3/MultiRegionAccessPointArn.php',
    'Aws\Arn\S3\OutpostsAccessPointArn' => __DIR__ . '/Aws/Arn/S3/OutpostsAccessPointArn.php',
    'Aws\Arn\S3\OutpostsArnInterface' => __DIR__ . '/Aws/Arn/S3/OutpostsArnInterface.php',
    'Aws\Arn\S3\OutpostsBucketArn' => __DIR__ . '/Aws/Arn/S3/OutpostsBucketArn.php',
    'Aws\AwsClient' => __DIR__ . '/Aws/AwsClient.php',
    'Aws\AwsClientInterface' => __DIR__ . '/Aws/AwsClientInterface.php',
    'Aws\AwsClientTrait' => __DIR__ . '/Aws/AwsClientTrait.php',
    'Aws\CacheInterface' => __DIR__ . '/Aws/CacheInterface.php',
    'Aws\ClientResolver' => __DIR__ . '/Aws/ClientResolver.php',
    'Aws\ClientSideMonitoring\AbstractMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/AbstractMonitoringMiddleware.php',
    'Aws\ClientSideMonitoring\ApiCallAttemptMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/ApiCallAttemptMonitoringMiddleware.php',
    'Aws\ClientSideMonitoring\ApiCallMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/ApiCallMonitoringMiddleware.php',
    'Aws\ClientSideMonitoring\Configuration' => __DIR__ . '/Aws/ClientSideMonitoring/Configuration.php',
    'Aws\ClientSideMonitoring\ConfigurationInterface' => __DIR__ . '/Aws/ClientSideMonitoring/ConfigurationInterface.php',
    'Aws\ClientSideMonitoring\ConfigurationProvider' => __DIR__ . '/Aws/ClientSideMonitoring/ConfigurationProvider.php',
    'Aws\ClientSideMonitoring\Exception\ConfigurationException' => __DIR__ . '/Aws/ClientSideMonitoring/Exception/ConfigurationException.php',
    'Aws\ClientSideMonitoring\MonitoringMiddlewareInterface' => __DIR__ . '/Aws/ClientSideMonitoring/MonitoringMiddlewareInterface.php',
    'Aws\CloudFront\CookieSigner' => __DIR__ . '/Aws/CloudFront/CookieSigner.php',
    'Aws\CloudFront\Signer' => __DIR__ . '/Aws/CloudFront/Signer.php',
    'Aws\CloudFront\UrlSigner' => __DIR__ . '/Aws/CloudFront/UrlSigner.php',
    'Aws\CloudTrail\LogFileIterator' => __DIR__ . '/Aws/CloudTrail/LogFileIterator.php',
    'Aws\CloudTrail\LogFileReader' => __DIR__ . '/Aws/CloudTrail/LogFileReader.php',
    'Aws\CloudTrail\LogRecordIterator' => __DIR__ . '/Aws/CloudTrail/LogRecordIterator.php',
    'Aws\CloudWatch\CloudWatchClient' => __DIR__ . '/Aws/CloudWatch/CloudWatchClient.php',
    'Aws\CloudWatch\Exception\CloudWatchException' => __DIR__ . '/Aws/CloudWatch/Exception/CloudWatchException.php',
    'Aws\CognitoIdentity\CognitoIdentityProvider' => __DIR__ . '/Aws/CognitoIdentity/CognitoIdentityProvider.php',
    'Aws\Command' => __DIR__ . '/Aws/Command.php',
    'Aws\CommandInterface' => __DIR__ . '/Aws/CommandInterface.php',
    'Aws\CommandPool' => __DIR__ . '/Aws/CommandPool.php',
    'Aws\ConfigurationProviderInterface' => __DIR__ . '/Aws/ConfigurationProviderInterface.php',
    'Aws\Credentials\AssumeRoleCredentialProvider' => __DIR__ . '/Aws/Credentials/AssumeRoleCredentialProvider.php',
    'Aws\Credentials\AssumeRoleWithWebIdentityCredentialProvider' => __DIR__ . '/Aws/Credentials/AssumeRoleWithWebIdentityCredentialProvider.php',
    'Aws\Credentials\CredentialProvider' => __DIR__ . '/Aws/Credentials/CredentialProvider.php',
    'Aws\Credentials\Credentials' => __DIR__ . '/Aws/Credentials/Credentials.php',
    'Aws\Credentials\CredentialsInterface' => __DIR__ . '/Aws/Credentials/CredentialsInterface.php',
    'Aws\Credentials\EcsCredentialProvider' => __DIR__ . '/Aws/Credentials/EcsCredentialProvider.php',
    'Aws\Credentials\InstanceProfileProvider' => __DIR__ . '/Aws/Credentials/InstanceProfileProvider.php',
    'Aws\Crypto\AbstractCryptoClient' => __DIR__ . '/Aws/Crypto/AbstractCryptoClient.php',
    'Aws\Crypto\AbstractCryptoClientV2' => __DIR__ . '/Aws/Crypto/AbstractCryptoClientV2.php',
    'Aws\Crypto\AesDecryptingStream' => __DIR__ . '/Aws/Crypto/AesDecryptingStream.php',
    'Aws\Crypto\AesEncryptingStream' => __DIR__ . '/Aws/Crypto/AesEncryptingStream.php',
    'Aws\Crypto\AesGcmDecryptingStream' => __DIR__ . '/Aws/Crypto/AesGcmDecryptingStream.php',
    'Aws\Crypto\AesGcmEncryptingStream' => __DIR__ . '/Aws/Crypto/AesGcmEncryptingStream.php',
    'Aws\Crypto\AesStreamInterface' => __DIR__ . '/Aws/Crypto/AesStreamInterface.php',
    'Aws\Crypto\AesStreamInterfaceV2' => __DIR__ . '/Aws/Crypto/AesStreamInterfaceV2.php',
    'Aws\Crypto\Cipher\Cbc' => __DIR__ . '/Aws/Crypto/Cipher/Cbc.php',
    'Aws\Crypto\Cipher\CipherBuilderTrait' => __DIR__ . '/Aws/Crypto/Cipher/CipherBuilderTrait.php',
    'Aws\Crypto\Cipher\CipherMethod' => __DIR__ . '/Aws/Crypto/Cipher/CipherMethod.php',
    'Aws\Crypto\DecryptionTrait' => __DIR__ . '/Aws/Crypto/DecryptionTrait.php',
    'Aws\Crypto\DecryptionTraitV2' => __DIR__ . '/Aws/Crypto/DecryptionTraitV2.php',
    'Aws\Crypto\EncryptionTrait' => __DIR__ . '/Aws/Crypto/EncryptionTrait.php',
    'Aws\Crypto\EncryptionTraitV2' => __DIR__ . '/Aws/Crypto/EncryptionTraitV2.php',
    'Aws\Crypto\KmsMaterialsProvider' => __DIR__ . '/Aws/Crypto/KmsMaterialsProvider.php',
    'Aws\Crypto\KmsMaterialsProviderV2' => __DIR__ . '/Aws/Crypto/KmsMaterialsProviderV2.php',
    'Aws\Crypto\MaterialsProvider' => __DIR__ . '/Aws/Crypto/MaterialsProvider.php',
    'Aws\Crypto\MaterialsProviderInterface' => __DIR__ . '/Aws/Crypto/MaterialsProviderInterface.php',
    'Aws\Crypto\MaterialsProviderInterfaceV2' => __DIR__ . '/Aws/Crypto/MaterialsProviderInterfaceV2.php',
    'Aws\Crypto\MaterialsProviderV2' => __DIR__ . '/Aws/Crypto/MaterialsProviderV2.php',
    'Aws\Crypto\MetadataEnvelope' => __DIR__ . '/Aws/Crypto/MetadataEnvelope.php',
    'Aws\Crypto\MetadataStrategyInterface' => __DIR__ . '/Aws/Crypto/MetadataStrategyInterface.php',
    'Aws\Crypto\Polyfill\AesGcm' => __DIR__ . '/Aws/Crypto/Polyfill/AesGcm.php',
    'Aws\Crypto\Polyfill\ByteArray' => __DIR__ . '/Aws/Crypto/Polyfill/ByteArray.php',
    'Aws\Crypto\Polyfill\Gmac' => __DIR__ . '/Aws/Crypto/Polyfill/Gmac.php',
    'Aws\Crypto\Polyfill\Key' => __DIR__ . '/Aws/Crypto/Polyfill/Key.php',
    'Aws\Crypto\Polyfill\NeedsTrait' => __DIR__ . '/Aws/Crypto/Polyfill/NeedsTrait.php',
    'Aws\data\sqs\2012-11-05\api-2.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/api-2.json.php',
    'Aws\data\sqs\2012-11-05\endpoint-rule-set-1.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/endpoint-rule-set-1.json.php',
    'Aws\data\sqs\2012-11-05\endpoint-tests-1.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/endpoint-tests-1.json.php',
    'Aws\data\sqs\2012-11-05\paginators-1.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/paginators-1.json.php',
    'Aws\data\sqs\2012-11-05\smoke.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/smoke.json.php',
    'Aws\data\sqs\2012-11-05\waiters-2.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/waiters-2.json.php',
    'Aws\DefaultsMode\Configuration' => __DIR__ . '/Aws/DefaultsMode/Configuration.php',
    'Aws\DefaultsMode\ConfigurationInterface' => __DIR__ . '/Aws/DefaultsMode/ConfigurationInterface.php',
    'Aws\DefaultsMode\ConfigurationProvider' => __DIR__ . '/Aws/DefaultsMode/ConfigurationProvider.php',
    'Aws\DefaultsMode\Exception\ConfigurationException' => __DIR__ . '/Aws/DefaultsMode/Exception/ConfigurationException.php',
    'Aws\DoctrineCacheAdapter' => __DIR__ . '/Aws/DoctrineCacheAdapter.php',
    'Aws\DynamoDb\BinaryValue' => __DIR__ . '/Aws/DynamoDb/BinaryValue.php',
    'Aws\DynamoDb\LockingSessionConnection' => __DIR__ . '/Aws/DynamoDb/LockingSessionConnection.php',
    'Aws\DynamoDb\Marshaler' => __DIR__ . '/Aws/DynamoDb/Marshaler.php',
    'Aws\DynamoDb\NumberValue' => __DIR__ . '/Aws/DynamoDb/NumberValue.php',
    'Aws\DynamoDb\SessionConnectionConfigTrait' => __DIR__ . '/Aws/DynamoDb/SessionConnectionConfigTrait.php',
    'Aws\DynamoDb\SessionConnectionInterface' => __DIR__ . '/Aws/DynamoDb/SessionConnectionInterface.php',
    'Aws\DynamoDb\SessionHandler' => __DIR__ . '/Aws/DynamoDb/SessionHandler.php',
    'Aws\DynamoDb\SetValue' => __DIR__ . '/Aws/DynamoDb/SetValue.php',
    'Aws\DynamoDb\StandardSessionConnection' => __DIR__ . '/Aws/DynamoDb/StandardSessionConnection.php',
    'Aws\DynamoDb\WriteRequestBatch' => __DIR__ . '/Aws/DynamoDb/WriteRequestBatch.php',
    'Aws\Endpoint\EndpointProvider' => __DIR__ . '/Aws/Endpoint/EndpointProvider.php',
    'Aws\Endpoint\Partition' => __DIR__ . '/Aws/Endpoint/Partition.php',
    'Aws\Endpoint\PartitionEndpointProvider' => __DIR__ . '/Aws/Endpoint/PartitionEndpointProvider.php',
    'Aws\Endpoint\PartitionInterface' => __DIR__ . '/Aws/Endpoint/PartitionInterface.php',
    'Aws\Endpoint\PatternEndpointProvider' => __DIR__ . '/Aws/Endpoint/PatternEndpointProvider.php',
    'Aws\Endpoint\UseDualstackEndpoint\Configuration' => __DIR__ . '/Aws/Endpoint/UseDualstackEndpoint/Configuration.php',
    'Aws\Endpoint\UseDualstackEndpoint\ConfigurationInterface' => __DIR__ . '/Aws/Endpoint/UseDualstackEndpoint/ConfigurationInterface.php',
    'Aws\Endpoint\UseDualstackEndpoint\ConfigurationProvider' => __DIR__ . '/Aws/Endpoint/UseDualstackEndpoint/ConfigurationProvider.php',
    'Aws\Endpoint\UseDualstackEndpoint\Exception\ConfigurationException' => __DIR__ . '/Aws/Endpoint/UseDualstackEndpoint/Exception/ConfigurationException.php',
    'Aws\Endpoint\UseFipsEndpoint\Configuration' => __DIR__ . '/Aws/Endpoint/UseFipsEndpoint/Configuration.php',
    'Aws\Endpoint\UseFipsEndpoint\ConfigurationInterface' => __DIR__ . '/Aws/Endpoint/UseFipsEndpoint/ConfigurationInterface.php',
    'Aws\Endpoint\UseFipsEndpoint\ConfigurationProvider' => __DIR__ . '/Aws/Endpoint/UseFipsEndpoint/ConfigurationProvider.php',
    'Aws\Endpoint\UseFipsEndpoint\Exception\ConfigurationException' => __DIR__ . '/Aws/Endpoint/UseFipsEndpoint/Exception/ConfigurationException.php',
    'Aws\EndpointDiscovery\Configuration' => __DIR__ . '/Aws/EndpointDiscovery/Configuration.php',
    'Aws\EndpointDiscovery\ConfigurationInterface' => __DIR__ . '/Aws/EndpointDiscovery/ConfigurationInterface.php',
    'Aws\EndpointDiscovery\ConfigurationProvider' => __DIR__ . '/Aws/EndpointDiscovery/ConfigurationProvider.php',
    'Aws\EndpointDiscovery\EndpointDiscoveryMiddleware' => __DIR__ . '/Aws/EndpointDiscovery/EndpointDiscoveryMiddleware.php',
    'Aws\EndpointDiscovery\EndpointList' => __DIR__ . '/Aws/EndpointDiscovery/EndpointList.php',
    'Aws\EndpointDiscovery\Exception\ConfigurationException' => __DIR__ . '/Aws/EndpointDiscovery/Exception/ConfigurationException.php',
    'Aws\EndpointV2\EndpointDefinitionProvider' => __DIR__ . '/Aws/EndpointV2/EndpointDefinitionProvider.php',
    'Aws\EndpointV2\EndpointProviderV2' => __DIR__ . '/Aws/EndpointV2/EndpointProviderV2.php',
    'Aws\EndpointV2\EndpointV2SerializerTrait' => __DIR__ . '/Aws/EndpointV2/EndpointV2SerializerTrait.php',
    'Aws\EndpointV2\Rule\AbstractRule' => __DIR__ . '/Aws/EndpointV2/Rule/AbstractRule.php',
    'Aws\EndpointV2\Rule\EndpointRule' => __DIR__ . '/Aws/EndpointV2/Rule/EndpointRule.php',
    'Aws\EndpointV2\Rule\ErrorRule' => __DIR__ . '/Aws/EndpointV2/Rule/ErrorRule.php',
    'Aws\EndpointV2\Rule\RuleCreator' => __DIR__ . '/Aws/EndpointV2/Rule/RuleCreator.php',
    'Aws\EndpointV2\Rule\TreeRule' => __DIR__ . '/Aws/EndpointV2/Rule/TreeRule.php',
    'Aws\EndpointV2\Ruleset\Ruleset' => __DIR__ . '/Aws/EndpointV2/Ruleset/Ruleset.php',
    'Aws\EndpointV2\Ruleset\RulesetEndpoint' => __DIR__ . '/Aws/EndpointV2/Ruleset/RulesetEndpoint.php',
    'Aws\EndpointV2\Ruleset\RulesetParameter' => __DIR__ . '/Aws/EndpointV2/Ruleset/RulesetParameter.php',
    'Aws\EndpointV2\Ruleset\RulesetStandardLibrary' => __DIR__ . '/Aws/EndpointV2/Ruleset/RulesetStandardLibrary.php',
    'Aws\EndpointParameterMiddleware' => __DIR__ . '/Aws/EndpointParameterMiddleware.php',
    'Aws\EventBridge\EventBridgeEndpointMiddleware' => __DIR__ . '/Aws/EventBridge/EventBridgeEndpointMiddleware.php',
    'Aws\Exception\AwsException' => __DIR__ . '/Aws/Exception/AwsException.php',
    'Aws\Exception\CommonRuntimeException' => __DIR__ . '/Aws/Exception/CommonRuntimeException.php',
    'Aws\Exception\CouldNotCreateChecksumException' => __DIR__ . '/Aws/Exception/CouldNotCreateChecksumException.php',
    'Aws\Exception\CredentialsException' => __DIR__ . '/Aws/Exception/CredentialsException.php',
    'Aws\Exception\CryptoException' => __DIR__ . '/Aws/Exception/CryptoException.php',
    'Aws\Exception\CryptoPolyfillException' => __DIR__ . '/Aws/Exception/CryptoPolyfillException.php',
    'Aws\Exception\EventStreamDataException' => __DIR__ . '/Aws/Exception/EventStreamDataException.php',
    'Aws\Exception\IncalculablePayloadException' => __DIR__ . '/Aws/Exception/IncalculablePayloadException.php',
    'Aws\Exception\InvalidJsonException' => __DIR__ . '/Aws/Exception/InvalidJsonException.php',
    'Aws\Exception\InvalidRegionException' => __DIR__ . '/Aws/Exception/InvalidRegionException.php',
    'Aws\Exception\MultipartUploadException' => __DIR__ . '/Aws/Exception/MultipartUploadException.php',
    'Aws\Exception\TokenException' => __DIR__ . '/Aws/Exception/TokenException.php',
    'Aws\Exception\UnresolvedApiException' => __DIR__ . '/Aws/Exception/UnresolvedApiException.php',
    'Aws\Exception\UnresolvedEndpointException' => __DIR__ . '/Aws/Exception/UnresolvedEndpointException.php',
    'Aws\Exception\UnresolvedSignatureException' => __DIR__ . '/Aws/Exception/UnresolvedSignatureException.php',
    'Aws\Glacier\MultipartUploader' => __DIR__ . '/Aws/Glacier/MultipartUploader.php',
    'Aws\Glacier\TreeHash' => __DIR__ . '/Aws/Glacier/TreeHash.php',
    'Aws\Handler\GuzzleV5\GuzzleHandler' => __DIR__ . '/Aws/Handler/GuzzleV5/GuzzleHandler.php',
    'Aws\Handler\GuzzleV5\GuzzleStream' => __DIR__ . '/Aws/Handler/GuzzleV5/GuzzleStream.php',
    'Aws\Handler\GuzzleV5\PsrStream' => __DIR__ . '/Aws/Handler/GuzzleV5/PsrStream.php',
    'Aws\Handler\GuzzleV6\GuzzleHandler' => __DIR__ . '/Aws/Handler/GuzzleV6/GuzzleHandler.php',
    'Aws\HandlerList' => __DIR__ . '/Aws/HandlerList.php',
    'Aws\HasDataTrait' => __DIR__ . '/Aws/HasDataTrait.php',
    'Aws\HasMonitoringEventsTrait' => __DIR__ . '/Aws/HasMonitoringEventsTrait.php',
    'Aws\HashInterface' => __DIR__ . '/Aws/HashInterface.php',
    'Aws\HashingStream' => __DIR__ . '/Aws/HashingStream.php',
    'Aws\History' => __DIR__ . '/Aws/History.php',
    'Aws\IdempotencyTokenMiddleware' => __DIR__ . '/Aws/IdempotencyTokenMiddleware.php',
    'Aws\InputValidationMiddleware' => __DIR__ . '/Aws/InputValidationMiddleware.php',
    'Aws\JsonCompiler' => __DIR__ . '/Aws/JsonCompiler.php',
    'Aws\LruArrayCache' => __DIR__ . '/Aws/LruArrayCache.php',
    'Aws\Middleware' => __DIR__ . '/Aws/Middleware.php',
    'Aws\MockHandler' => __DIR__ . '/Aws/MockHandler.php',
    'Aws\MonitoringEventsInterface' => __DIR__ . '/Aws/MonitoringEventsInterface.php',
    'Aws\Multipart\AbstractUploadManager' => __DIR__ . '/Aws/Multipart/AbstractUploadManager.php',
    'Aws\Multipart\AbstractUploader' => __DIR__ . '/Aws/Multipart/AbstractUploader.php',
    'Aws\Multipart\UploadState' => __DIR__ . '/Aws/Multipart/UploadState.php',
    'Aws\PhpHash' => __DIR__ . '/Aws/PhpHash.php',
    'Aws\PresignUrlMiddleware' => __DIR__ . '/Aws/PresignUrlMiddleware.php',
    'Aws\Psr16CacheAdapter' => __DIR__ . '/Aws/Psr16CacheAdapter.php',
    'Aws\PsrCacheAdapter' => __DIR__ . '/Aws/PsrCacheAdapter.php',
    'Aws\Rds\AuthTokenGenerator' => __DIR__ . '/Aws/Rds/AuthTokenGenerator.php',
    'Aws\ResponseContainerInterface' => __DIR__ . '/Aws/ResponseContainerInterface.php',
    'Aws\Result' => __DIR__ . '/Aws/Result.php',
    'Aws\ResultInterface' => __DIR__ . '/Aws/ResultInterface.php',
    'Aws\ResultPaginator' => __DIR__ . '/Aws/ResultPaginator.php',
    'Aws\Retry\Configuration' => __DIR__ . '/Aws/Retry/Configuration.php',
    'Aws\Retry\ConfigurationInterface' => __DIR__ . '/Aws/Retry/ConfigurationInterface.php',
    'Aws\Retry\ConfigurationProvider' => __DIR__ . '/Aws/Retry/ConfigurationProvider.php',
    'Aws\Retry\Exception\ConfigurationException' => __DIR__ . '/Aws/Retry/Exception/ConfigurationException.php',
    'Aws\Retry\QuotaManager' => __DIR__ . '/Aws/Retry/QuotaManager.php',
    'Aws\Retry\RateLimiter' => __DIR__ . '/Aws/Retry/RateLimiter.php',
    'Aws\Retry\RetryHelperTrait' => __DIR__ . '/Aws/Retry/RetryHelperTrait.php',
    'Aws\RetryMiddleware' => __DIR__ . '/Aws/RetryMiddleware.php',
    'Aws\RetryMiddlewareV2' => __DIR__ . '/Aws/RetryMiddlewareV2.php',
    'Aws\S3\AmbiguousSuccessParser' => __DIR__ . '/Aws/S3/AmbiguousSuccessParser.php',
    'Aws\S3\ApplyChecksumMiddleware' => __DIR__ . '/Aws/S3/ApplyChecksumMiddleware.php',
    'Aws\S3\BatchDelete' => __DIR__ . '/Aws/S3/BatchDelete.php',
    'Aws\S3\BucketEndpointArnMiddleware' => __DIR__ . '/Aws/S3/BucketEndpointArnMiddleware.php',
    'Aws\S3\BucketEndpointMiddleware' => __DIR__ . '/Aws/S3/BucketEndpointMiddleware.php',
    'Aws\S3\CalculatesChecksumTrait' => __DIR__ . '/Aws/S3/CalculatesChecksumTrait.php',
    'Aws\S3\Crypto\CryptoParamsTrait' => __DIR__ . '/Aws/S3/Crypto/CryptoParamsTrait.php',
    'Aws\S3\Crypto\CryptoParamsTraitV2' => __DIR__ . '/Aws/S3/Crypto/CryptoParamsTraitV2.php',
    'Aws\S3\Crypto\HeadersMetadataStrategy' => __DIR__ . '/Aws/S3/Crypto/HeadersMetadataStrategy.php',
    'Aws\S3\Crypto\InstructionFileMetadataStrategy' => __DIR__ . '/Aws/S3/Crypto/InstructionFileMetadataStrategy.php',
    'Aws\S3\Crypto\S3EncryptionClientV2' => __DIR__ . '/Aws/S3/Crypto/S3EncryptionClientV2.php',
    'Aws\S3\Crypto\S3EncryptionMultipartUploader' => __DIR__ . '/Aws/S3/Crypto/S3EncryptionMultipartUploader.php',
    'Aws\S3\Crypto\S3EncryptionMultipartUploaderV2' => __DIR__ . '/Aws/S3/Crypto/S3EncryptionMultipartUploaderV2.php',
    'Aws\S3\Crypto\UserAgentTrait' => __DIR__ . '/Aws/S3/Crypto/UserAgentTrait.php',
    'Aws\S3\EndpointRegionHelperTrait' => __DIR__ . '/Aws/S3/EndpointRegionHelperTrait.php',
    'Aws\S3\GetBucketLocationParser' => __DIR__ . '/Aws/S3/GetBucketLocationParser.php',
    'Aws\S3\MultipartCopy' => __DIR__ . '/Aws/S3/MultipartCopy.php',
    'Aws\S3\MultipartUploader' => __DIR__ . '/Aws/S3/MultipartUploader.php',
    'Aws\S3\MultipartUploadingTrait' => __DIR__ . '/Aws/S3/MultipartUploadingTrait.php',
    'Aws\S3\ObjectCopier' => __DIR__ . '/Aws/S3/ObjectCopier.php',
    'Aws\S3\ObjectUploader' => __DIR__ . '/Aws/S3/ObjectUploader.php',
    'Aws\S3\PermanentRedirectMiddleware' => __DIR__ . '/Aws/S3/PermanentRedirectMiddleware.php',
    'Aws\S3\PostObject' => __DIR__ . '/Aws/S3/PostObject.php',
    'Aws\S3\PostObjectV4' => __DIR__ . '/Aws/S3/PostObjectV4.php',
    'Aws\S3\PutObjectUrlMiddleware' => __DIR__ . '/Aws/S3/PutObjectUrlMiddleware.php',
    'Aws\S3\RegionalEndpoint\Configuration' => __DIR__ . '/Aws/S3/RegionalEndpoint/Configuration.php',
    'Aws\S3\RegionalEndpoint\ConfigurationInterface' => __DIR__ . '/Aws/S3/RegionalEndpoint/ConfigurationInterface.php',
    'Aws\S3\RegionalEndpoint\ConfigurationProvider' => __DIR__ . '/Aws/S3/RegionalEndpoint/ConfigurationProvider.php',
    'Aws\S3\RetryableMalformedResponseParser' => __DIR__ . '/Aws/S3/RetryableMalformedResponseParser.php',
    'Aws\S3\S3ClientInterface' => __DIR__ . '/Aws/S3/S3ClientInterface.php',
    'Aws\S3\S3ClientTrait' => __DIR__ . '/Aws/S3/S3ClientTrait.php',
    'Aws\S3\S3EndpointMiddleware' => __DIR__ . '/Aws/S3/S3EndpointMiddleware.php',
    'Aws\S3\S3UriParser' => __DIR__ . '/Aws/S3/S3UriParser.php',
    'Aws\S3\SSECMiddleware' => __DIR__ . '/Aws/S3/SSECMiddleware.php',
    'Aws\S3\StreamWrapper' => __DIR__ . '/Aws/S3/StreamWrapper.php',
    'Aws\S3\Transfer' => __DIR__ . '/Aws/S3/Transfer.php',
    'Aws\S3\UseArnRegion\Configuration' => __DIR__ . '/Aws/S3/UseArnRegion/Configuration.php',
    'Aws\S3\UseArnRegion\ConfigurationInterface' => __DIR__ . '/Aws/S3/UseArnRegion/ConfigurationInterface.php',
    'Aws\S3\UseArnRegion\ConfigurationProvider' => __DIR__ . '/Aws/S3/UseArnRegion/ConfigurationProvider.php',
    'Aws\S3\ValidateResponseChecksumParser' => __DIR__ . '/Aws/S3/ValidateResponseChecksumParser.php',
    'Aws\S3Control\EndpointArnMiddleware' => __DIR__ . '/Aws/S3Control/EndpointArnMiddleware.php',
    'Aws\Script\Composer\Composer' => __DIR__ . '/Aws/Script/Composer/Composer.php',
    'Aws\Sdk' => __DIR__ . '/Aws/Sdk.php',
    'Aws\Signature\AnonymousSignature' => __DIR__ . '/Aws/Signature/AnonymousSignature.php',
    'Aws\Signature\S3SignatureV4' => __DIR__ . '/Aws/Signature/S3SignatureV4.php',
    'Aws\Signature\SignatureInterface' => __DIR__ . '/Aws/Signature/SignatureInterface.php',
    'Aws\Signature\SignatureProvider' => __DIR__ . '/Aws/Signature/SignatureProvider.php',
    'Aws\Signature\SignatureTrait' => __DIR__ . '/Aws/Signature/SignatureTrait.php',
    'Aws\Signature\SignatureV4' => __DIR__ . '/Aws/Signature/SignatureV4.php',
    'Aws\Sns\Message' => __DIR__ . '/Aws/Sns/Message.php',
    'Aws\Sns\MessageValidator' => __DIR__ . '/Aws/Sns/MessageValidator.php',
    'Aws\Sqs\Exception\SqsException' => __DIR__ . '/Aws/Sqs/Exception/SqsException.php',
    'Aws\Sqs\SqsClient' => __DIR__ . '/Aws/Sqs/SqsClient.php',
    'Aws\StreamRequestPayloadMiddleware' => __DIR__ . '/Aws/StreamRequestPayloadMiddleware.php',
    'Aws\Sts\RegionalEndpoints\Configuration' => __DIR__ . '/Aws/Sts/RegionalEndpoints/Configuration.php',
    'Aws\Sts\RegionalEndpoints\ConfigurationInterface' => __DIR__ . '/Aws/Sts/RegionalEndpoints/ConfigurationInterface.php',
    'Aws\Sts\RegionalEndpoints\ConfigurationProvider' => __DIR__ . '/Aws/Sts/RegionalEndpoints/ConfigurationProvider.php',
    'Aws\Token\BearerTokenAuthorization' => __DIR__ . '/Aws/Token/BearerTokenAuthorization.php',
    'Aws\Token\ParsesIniTrait' => __DIR__ . '/Aws/Token/ParsesIniTrait.php',
    'Aws\Token\RefreshableTokenProviderInterface' => __DIR__ . '/Aws/Token/RefreshableTokenProviderInterface.php',
    'Aws\Token\SsoToken' => __DIR__ . '/Aws/Token/SsoToken.php',
    'Aws\Token\SsoTokenProvider' => __DIR__ . '/Aws/Token/SsoTokenProvider.php',
    'Aws\Token\Token' => __DIR__ . '/Aws/Token/Token.php',
    'Aws\Token\TokenAuthorization' => __DIR__ . '/Aws/Token/TokenAuthorization.php',
    'Aws\Token\TokenInterface' => __DIR__ . '/Aws/Token/TokenInterface.php',
    'Aws\Token\TokenProvider' => __DIR__ . '/Aws/Token/TokenProvider.php',
    'Aws\TraceMiddleware' => __DIR__ . '/Aws/TraceMiddleware.php',
    'Aws\Waiter' => __DIR__ . '/Aws/Waiter.php',
    'Aws\WrappedHttpHandler' => __DIR__ . '/Aws/WrappedHttpHandler.php',
    'Aws\functions' => __DIR__ . '/Aws/functions.php',
    'JmesPath\AstRuntime' => __DIR__ . '/JmesPath/AstRuntime.php',
    'JmesPath\CompilerRuntime' => __DIR__ . '/JmesPath/CompilerRuntime.php',
    'JmesPath\DebugRuntime' => __DIR__ . '/JmesPath/DebugRuntime.php',
    'JmesPath\Env' => __DIR__ . '/JmesPath/Env.php',
    'JmesPath\FnDispatcher' => __DIR__ . '/JmesPath/FnDispatcher.php',
    'JmesPath\JmesPath' => __DIR__ . '/JmesPath/JmesPath.php',
    'JmesPath\Lexer' => __DIR__ . '/JmesPath/Lexer.php',
    'JmesPath\Parser' => __DIR__ . '/JmesPath/Parser.php',
    'JmesPath\SyntaxErrorException' => __DIR__ . '/JmesPath/SyntaxErrorException.php',
    'JmesPath\TreeCompiler' => __DIR__ . '/JmesPath/TreeCompiler.php',
    'JmesPath\TreeInterpreter' => __DIR__ . '/JmesPath/TreeInterpreter.php',
    'JmesPath\Utils' => __DIR__ . '/JmesPath/Utils.php',
    'GuzzleHttp\Client' => __DIR__ . '/GuzzleHttp/Client.php',
    'GuzzleHttp\ClientInterface' => __DIR__ . '/GuzzleHttp/ClientInterface.php',
    'GuzzleHttp\Cookie\CookieJar' => __DIR__ . '/GuzzleHttp/Cookie/CookieJar.php',
    'GuzzleHttp\Cookie\CookieJarInterface' => __DIR__ . '/GuzzleHttp/Cookie/CookieJarInterface.php',
    'GuzzleHttp\Cookie\FileCookieJar' => __DIR__ . '/GuzzleHttp/Cookie/FileCookieJar.php',
    'GuzzleHttp\Cookie\SessionCookieJar' => __DIR__ . '/GuzzleHttp/Cookie/SessionCookieJar.php',
    'GuzzleHttp\Cookie\SetCookie' => __DIR__ . '/GuzzleHttp/Cookie/SetCookie.php',
    'GuzzleHttp\Exception\BadResponseException' => __DIR__ . '/GuzzleHttp/Exception/BadResponseException.php',
    'GuzzleHttp\Exception\ClientException' => __DIR__ . '/GuzzleHttp/Exception/ClientException.php',
    'GuzzleHttp\Exception\ConnectException' => __DIR__ . '/GuzzleHttp/Exception/ConnectException.php',
    'GuzzleHttp\Exception\GuzzleException' => __DIR__ . '/GuzzleHttp/Exception/GuzzleException.php',
    'GuzzleHttp\Exception\InvalidArgumentException' => __DIR__ . '/GuzzleHttp/Exception/InvalidArgumentException.php',
    'GuzzleHttp\Exception\RequestException' => __DIR__ . '/GuzzleHttp/Exception/RequestException.php',
    'GuzzleHttp\Exception\SeekException' => __DIR__ . '/GuzzleHttp/Exception/SeekException.php',
    'GuzzleHttp\Exception\ServerException' => __DIR__ . '/GuzzleHttp/Exception/ServerException.php',
    'GuzzleHttp\Exception\TooManyRedirectsException' => __DIR__ . '/GuzzleHttp/Exception/TooManyRedirectsException.php',
    'GuzzleHttp\Exception\TransferException' => __DIR__ . '/GuzzleHttp/Exception/TransferException.php',
    'GuzzleHttp\Handler\CurlFactory' => __DIR__ . '/GuzzleHttp/Handler/CurlFactory.php',
    'GuzzleHttp\Handler\CurlFactoryInterface' => __DIR__ . '/GuzzleHttp/Handler/CurlFactoryInterface.php',
    'GuzzleHttp\Handler\CurlHandler' => __DIR__ . '/GuzzleHttp/Handler/CurlHandler.php',
    'GuzzleHttp\Handler\CurlMultiHandler' => __DIR__ . '/GuzzleHttp/Handler/CurlMultiHandler.php',
    'GuzzleHttp\Handler\EasyHandle' => __DIR__ . '/GuzzleHttp/Handler/EasyHandle.php',
    'GuzzleHttp\Handler\MockHandler' => __DIR__ . '/GuzzleHttp/Handler/MockHandler.php',
    'GuzzleHttp\Handler\Proxy' => __DIR__ . '/GuzzleHttp/Handler/Proxy.php',
    'GuzzleHttp\Handler\StreamHandler' => __DIR__ . '/GuzzleHttp/Handler/StreamHandler.php',
    'GuzzleHttp\HandlerStack' => __DIR__ . '/GuzzleHttp/HandlerStack.php',
    'GuzzleHttp\MessageFormatter' => __DIR__ . '/GuzzleHttp/MessageFormatter.php',
    'GuzzleHttp\Middleware' => __DIR__ . '/GuzzleHttp/Middleware.php',
    'GuzzleHttp\Pool' => __DIR__ . '/GuzzleHttp/Pool.php',
    'GuzzleHttp\PrepareBodyMiddleware' => __DIR__ . '/GuzzleHttp/PrepareBodyMiddleware.php',
    'GuzzleHttp\RedirectMiddleware' => __DIR__ . '/GuzzleHttp/RedirectMiddleware.php',
    'GuzzleHttp\RequestOptions' => __DIR__ . '/GuzzleHttp/RequestOptions.php',
    'GuzzleHttp\RetryMiddleware' => __DIR__ . '/GuzzleHttp/RetryMiddleware.php',
    'GuzzleHttp\TransferStats' => __DIR__ . '/GuzzleHttp/TransferStats.php',
    'GuzzleHttp\UriTemplate' => __DIR__ . '/GuzzleHttp/UriTemplate.php',
    'GuzzleHttp\Utils' => __DIR__ . '/GuzzleHttp/Utils.php',
    'GuzzleHttp\functions' => __DIR__ . '/GuzzleHttp/functions.php',
    'GuzzleHttp\functions_include' => __DIR__ . '/GuzzleHttp/functions_include.php',
    'GuzzleHttp\Psr7\AppendStream' => __DIR__ . '/GuzzleHttp/Psr7/AppendStream.php',
    'GuzzleHttp\Psr7\BufferStream' => __DIR__ . '/GuzzleHttp/Psr7/BufferStream.php',
    'GuzzleHttp\Psr7\CachingStream' => __DIR__ . '/GuzzleHttp/Psr7/CachingStream.php',
    'GuzzleHttp\Psr7\DroppingStream' => __DIR__ . '/GuzzleHttp/Psr7/DroppingStream.php',
    'GuzzleHttp\Psr7\FnStream' => __DIR__ . '/GuzzleHttp/Psr7/FnStream.php',
    'GuzzleHttp\Psr7\Header' => __DIR__ . '/GuzzleHttp/Psr7/Header.php',
    'GuzzleHttp\Psr7\InflateStream' => __DIR__ . '/GuzzleHttp/Psr7/InflateStream.php',
    'GuzzleHttp\Psr7\LazyOpenStream' => __DIR__ . '/GuzzleHttp/Psr7/LazyOpenStream.php',
    'GuzzleHttp\Psr7\LimitStream' => __DIR__ . '/GuzzleHttp/Psr7/LimitStream.php',
    'GuzzleHttp\Psr7\Message' => __DIR__ . '/GuzzleHttp/Psr7/Message.php',
    'GuzzleHttp\Psr7\MessageTrait' => __DIR__ . '/GuzzleHttp/Psr7/MessageTrait.php',
    'GuzzleHttp\Psr7\MimeType' => __DIR__ . '/GuzzleHttp/Psr7/MimeType.php',
    'GuzzleHttp\Psr7\MultipartStream' => __DIR__ . '/GuzzleHttp/Psr7/MultipartStream.php',
    'GuzzleHttp\Psr7\NoSeekStream' => __DIR__ . '/GuzzleHttp/Psr7/NoSeekStream.php',
    'GuzzleHttp\Psr7\PumpStream' => __DIR__ . '/GuzzleHttp/Psr7/PumpStream.php',
    'GuzzleHttp\Psr7\Query' => __DIR__ . '/GuzzleHttp/Psr7/Query.php',
    'GuzzleHttp\Psr7\Request' => __DIR__ . '/GuzzleHttp/Psr7/Request.php',
    'GuzzleHttp\Psr7\Response' => __DIR__ . '/GuzzleHttp/Psr7/Response.php',
    'GuzzleHttp\Psr7\Rfc7230' => __DIR__ . '/GuzzleHttp/Psr7/Rfc7230.php',
    'GuzzleHttp\Psr7\ServerRequest' => __DIR__ . '/GuzzleHttp/Psr7/ServerRequest.php',
    'GuzzleHttp\Psr7\Stream' => __DIR__ . '/GuzzleHttp/Psr7/Stream.php',
    'GuzzleHttp\Psr7\StreamDecoratorTrait' => __DIR__ . '/GuzzleHttp/Psr7/StreamDecoratorTrait.php',
    'GuzzleHttp\Psr7\StreamWrapper' => __DIR__ . '/GuzzleHttp/Psr7/StreamWrapper.php',
    'GuzzleHttp\Psr7\UploadedFile' => __DIR__ . '/GuzzleHttp/Psr7/UploadedFile.php',
    'GuzzleHttp\Psr7\Uri' => __DIR__ . '/GuzzleHttp/Psr7/Uri.php',
    'GuzzleHttp\Psr7\UriComparator' => __DIR__ . '/GuzzleHttp/Psr7/UriComparator.php',
    'GuzzleHttp\Psr7\UriNormalizer' => __DIR__ . '/GuzzleHttp/Psr7/UriNormalizer.php',
    'GuzzleHttp\Psr7\UriResolver' => __DIR__ . '/GuzzleHttp/Psr7/UriResolver.php',
    'GuzzleHttp\Psr7\Utils' => __DIR__ . '/GuzzleHttp/Psr7/Utils.php',
    'GuzzleHttp\Psr7\functions' => __DIR__ . '/GuzzleHttp/Psr7/functions.php',
    'GuzzleHttp\Psr7\functions_include' => __DIR__ . '/GuzzleHttp/Psr7/functions_include.php',
    'GuzzleHttp\Promise\Coroutine' => __DIR__ . '/GuzzleHttp/Promise/Coroutine.php',
    'GuzzleHttp\Promise\Create' => __DIR__ . '/GuzzleHttp/Promise/Create.php',
    'GuzzleHttp\Promise\Each' => __DIR__ . '/GuzzleHttp/Promise/Each.php',
    'GuzzleHttp\Promise\EachPromise' => __DIR__ . '/GuzzleHttp/Promise/EachPromise.php',
    'GuzzleHttp\Promise\FulfilledPromise' => __DIR__ . '/GuzzleHttp/Promise/FulfilledPromise.php',
    'GuzzleHttp\Promise\Is' => __DIR__ . '/GuzzleHttp/Promise/Is.php',
    'GuzzleHttp\Promise\Promise' => __DIR__ . '/GuzzleHttp/Promise/Promise.php',
    'GuzzleHttp\Promise\PromiseInterface' => __DIR__ . '/GuzzleHttp/Promise/PromiseInterface.php',
    'GuzzleHttp\Promise\PromisorInterface' => __DIR__ . '/GuzzleHttp/Promise/PromisorInterface.php',
    'GuzzleHttp\Promise\RejectedPromise' => __DIR__ . '/GuzzleHttp/Promise/RejectedPromise.php',
    'GuzzleHttp\Promise\TaskQueue' => __DIR__ . '/GuzzleHttp/Promise/TaskQueue.php',
    'GuzzleHttp\Promise\TaskQueueInterface' => __DIR__ . '/GuzzleHttp/Promise/TaskQueueInterface.php',
    'GuzzleHttp\Promise\Utils' => __DIR__ . '/GuzzleHttp/Promise/Utils.php',
    'GuzzleHttp\Promise\functions' => __DIR__ . '/GuzzleHttp/Promise/functions.php',
    'GuzzleHttp\Promise\functions_include' => __DIR__ . '/GuzzleHttp/Promise/functions_include.php',
    'Psr\Http\Message\MessageInterface' => __DIR__ . '/Psr/Http/Message/MessageInterface.php',
    'Psr\Http\Message\RequestInterface' => __DIR__ . '/Psr/Http/Message/RequestInterface.php',
    'Psr\Http\Message\ResponseInterface' => __DIR__ . '/Psr/Http/Message/ResponseInterface.php',
    'Psr\Http\Message\ServerRequestInterface' => __DIR__ . '/Psr/Http/Message/ServerRequestInterface.php',
    'Psr\Http\Message\StreamInterface' => __DIR__ . '/Psr/Http/Message/StreamInterface.php',
    'Psr\Http\Message\UploadedFileInterface' => __DIR__ . '/Psr/Http/Message/UploadedFileInterface.php',
    'Psr\Http\Message\UriInterface' => __DIR__ . '/Psr/Http/Message/UriInterface.php',
    'Symfony\Polyfill\Intl\Idn\Idn' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Idn.php',
    'Symfony\Polyfill\Intl\Idn\Info' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Info.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\DisallowedRanges' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/DisallowedRanges.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/Regex.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\deviation' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/deviation.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\disallowed' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/disallowed.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\disallowed_STD3_mapped' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/disallowed_STD3_mapped.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\disallowed_STD3_valid' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/disallowed_STD3_valid.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\ignored' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/ignored.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\mapped' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/mapped.php',
    'Symfony\Polyfill\Intl\Idn\Resources\unidata\virama' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/Resources/unidata/virama.php',
    'Symfony\Polyfill\Intl\Idn\bootstrap' => __DIR__ . '/Symfony/Polyfill/Intl/Idn/bootstrap.php',
);

spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require $mapping[$class];
    }
}, true);

require __DIR__ . '/Aws/functions.php';
require __DIR__ . '/GuzzleHttp/functions_include.php';
require __DIR__ . '/GuzzleHttp/Psr7/functions_include.php';
require __DIR__ . '/GuzzleHttp/Promise/functions_include.php';
require __DIR__ . '/JmesPath/JmesPath.php';
require __DIR__ . '/Symfony/Polyfill/Intl/Idn/bootstrap.php';
