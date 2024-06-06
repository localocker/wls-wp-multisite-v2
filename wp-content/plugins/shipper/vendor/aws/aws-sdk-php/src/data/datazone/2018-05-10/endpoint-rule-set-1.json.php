<?php
// This file was auto-generated from sdk-root/src/data/datazone/2018-05-10/endpoint-rule-set-1.json
return [ 'version' => '1.0', 'parameters' => [ 'Region' => [ 'builtIn' => 'AWS::Region', 'required' => false, 'documentation' => 'The AWS region used to dispatch the request.', 'type' => 'String', ], 'UseFIPS' => [ 'builtIn' => 'AWS::UseFIPS', 'required' => true, 'default' => false, 'documentation' => 'When true, send this request to the FIPS-compliant regional endpoint. If the configured endpoint does not have a FIPS compliant endpoint, dispatching the request will return an error.', 'type' => 'Boolean', ], 'Endpoint' => [ 'builtIn' => 'SDK::Endpoint', 'required' => false, 'documentation' => 'Override the endpoint used to send this request', 'type' => 'String', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'Endpoint', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'ref' => 'UseFIPS', ], true, ], ], ], 'error' => 'Invalid Configuration: FIPS and custom endpoint are not supported', 'type' => 'error', ], [ 'conditions' => [], 'endpoint' => [ 'url' => [ 'ref' => 'Endpoint', ], 'properties' => [], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [ [ 'fn' => 'isSet', 'argv' => [ [ 'ref' => 'Region', ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'aws.partition', 'argv' => [ [ 'ref' => 'Region', ], ], 'assign' => 'PartitionResult', ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ true, [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'PartitionResult', ], 'supportsDualStack', ], ], ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'ref' => 'UseFIPS', ], true, ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'PartitionResult', ], 'supportsFIPS', ], ], true, ], ], ], 'rules' => [ [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://datazone-fips.{Region}.{PartitionResult#dualStackDnsSuffix}', 'properties' => [], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'FIPS is enabled but this partition does not support FIPS', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://datazone.{Region}.{PartitionResult#dualStackDnsSuffix}', 'properties' => [], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'ref' => 'UseFIPS', ], true, ], ], ], 'rules' => [ [ 'conditions' => [ [ 'fn' => 'booleanEquals', 'argv' => [ [ 'fn' => 'getAttr', 'argv' => [ [ 'ref' => 'PartitionResult', ], 'supportsFIPS', ], ], true, ], ], ], 'rules' => [ [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://datazone-fips.{Region}.{PartitionResult#dnsSuffix}', 'properties' => [], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'FIPS is enabled but this partition does not support FIPS', 'type' => 'error', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'endpoint' => [ 'url' => 'https://datazone.{Region}.{PartitionResult#dnsSuffix}', 'properties' => [], 'headers' => [], ], 'type' => 'endpoint', ], ], 'type' => 'tree', ], ], 'type' => 'tree', ], [ 'conditions' => [], 'error' => 'Invalid Configuration: Missing Region', 'type' => 'error', ], ],];