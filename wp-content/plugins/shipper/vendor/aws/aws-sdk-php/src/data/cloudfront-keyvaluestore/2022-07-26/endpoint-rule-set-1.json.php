<?php
// This file was auto-generated from sdk-root/src/data/cloudfront-keyvaluestore/2022-07-26/endpoint-rule-set-1.json
return [ 'version' => '1.0', 'parameters' => [ 'KvsARN' => [ 'required' => false, 'documentation' => 'The ARN of the Key Value Store', 'type' => 'String', ], 'Region' => [ 'builtIn' => 'AWS::Region', 'required' => false, 'documentation' => 'The AWS region used to dispatch the request.', 'type' => 'String', ], 'UseFIPS' => [ 'builtIn' => 'AWS::UseFIPS', 'required' => true, 'default' => false, 'documentation' => 'When true, send this request to the FIPS-compliant regional endpoint. If the configured endpoint does not have a FIPS compliant endpoint, dispatching the request will return an error.', 'type' => 'Boolean', ], 'Endpoint' => [ 'builtIn' => 'SDK::Endpoint', 'required' => false, 'documentation' => 'Override the endpoint used to send this request', 'type' => 'String', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'ref' => 'UseFIPS', ], false, ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'KvsARN', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'aws.parseArn', 'argv' => [ [ 'ref' => 'KvsARN', ], ], 'assign' => 'parsedArn', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'parsedArn', ], 'service', ], ], 'cloudfront', ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'parsedArn', ], 'region', ], ], '', ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'parsedArn', ], 'resourceId[0]', ], 'assign' => 'arnType', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'not', 'argv' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'ref' => 'arnType', ], '', ], ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'ref' => 'arnType', ], 'key-value-store', ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'parsedArn', ], 'partition', ], ], 'aws', ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'Region', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'aws.partition', 'argv' => [ [ 'ref' => 'Region', ], ], 'assign' => 'partitionResult', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'stringEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'partitionResult', ], 'name', ], ], '{parsedArn#partition}', ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'Endpoint', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'parseURL', 'argv' => [ [ 'ref' => 'Endpoint', ], ], 'assign' => 'url', ], ], 'rules' => [ [ 'conditions' => [], 'endpoint' => [ 'url' => '{url#scheme}://{parsedArn#accountId}.{url#authority}{url#path}', 'properties' => [ 'authSchemes' => [ [ 'name' => 'sigv4a', 'signingName' => 'cloudfront-keyvaluestore', 'signingRegionSet' => [ '*', ], ], ], ], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Provided endpoint is not a valid URL', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://{parsedArn#accountId}.cloudfront-kvs.global.api.aws', 'properties' => [ 'authSchemes' => [ [ 'name' => 'sigv4a', 'signingName' => 'cloudfront-keyvaluestore', 'signingRegionSet' => [ '*', ], ], ], ], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Client was configured for partition `{partitionResult#name}` but Kvs ARN has `{parsedArn#partition}`', 'type' => 'error', ], ], 'type' => 'tree', ], ], 'type' => 'tree', ], [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'Endpoint', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'parseURL', 'argv' => [ [ 'ref' => 'Endpoint', ], ], 'assign' => 'url', ], ], 'rules' => [ [ 'conditions' => [], 'endpoint' => [ 'url' => '{url#scheme}://{parsedArn#accountId}.{url#authority}{url#path}', 'properties' => [ 'authSchemes' => [ [ 'name' => 'sigv4a', 'signingName' => 'cloudfront-keyvaluestore', 'signingRegionSet' => [ '*', ], ], ], ], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Provided endpoint is not a valid URL', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://{parsedArn#accountId}.cloudfront-kvs.global.api.aws', 'properties' => [ 'authSchemes' => [ [ 'name' => 'sigv4a', 'signingName' => 'cloudfront-keyvaluestore', 'signingRegionSet' => [ '*', ], ], ], ], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'CloudFront-KeyValueStore is not supported in partition `{parsedArn#partition}`', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'ARN resource type is invalid. Expected `key-value-store`, found: `{arnType}`', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'No resource type found in the KVS ARN. Resource type must be `key-value-store`.', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'No resource type found in the KVS ARN. Resource type must be `key-value-store`.', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Provided ARN must be a global resource ARN. Found: `{parsedArn#region}`', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Provided ARN is not a valid CloudFront Service ARN. Found: `{parsedArn#service}`', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'KVS ARN must be a valid ARN', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'KVS ARN must be provided to use this service', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Invalid Configuration: FIPS is not supported with CloudFront-KeyValueStore.', 'type' => 'error', ], ],];