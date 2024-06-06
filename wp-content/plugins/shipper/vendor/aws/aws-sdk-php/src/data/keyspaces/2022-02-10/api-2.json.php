<?php
// This file was auto-generated from sdk-root/src/data/keyspaces/2022-02-10/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2022-02-10', 'endpointPrefix' => 'cassandra', 'jsonVersion' => '1.0', 'protocol' => 'json', 'serviceFullName' => 'Amazon Keyspaces', 'serviceId' => 'Keyspaces', 'signatureVersion' => 'v4', 'signingName' => 'cassandra', 'targetPrefix' => 'KeyspacesService', 'uid' => 'keyspaces-2022-02-10', ], 'operations' => [ 'CreateKeyspace' => [ 'name' => 'CreateKeyspace', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateKeyspaceRequest', ], 'output' => [ 'shape' => 'CreateKeyspaceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], ], ], 'CreateTable' => [ 'name' => 'CreateTable', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateTableRequest', ], 'output' => [ 'shape' => 'CreateTableResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DeleteKeyspace' => [ 'name' => 'DeleteKeyspace', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteKeyspaceRequest', ], 'output' => [ 'shape' => 'DeleteKeyspaceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DeleteTable' => [ 'name' => 'DeleteTable', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteTableRequest', ], 'output' => [ 'shape' => 'DeleteTableResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'GetKeyspace' => [ 'name' => 'GetKeyspace', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetKeyspaceRequest', ], 'output' => [ 'shape' => 'GetKeyspaceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'GetTable' => [ 'name' => 'GetTable', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetTableRequest', ], 'output' => [ 'shape' => 'GetTableResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'GetTableAutoScalingSettings' => [ 'name' => 'GetTableAutoScalingSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetTableAutoScalingSettingsRequest', ], 'output' => [ 'shape' => 'GetTableAutoScalingSettingsResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'ListKeyspaces' => [ 'name' => 'ListKeyspaces', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListKeyspacesRequest', ], 'output' => [ 'shape' => 'ListKeyspacesResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'ListTables' => [ 'name' => 'ListTables', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListTablesRequest', ], 'output' => [ 'shape' => 'ListTablesResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'ListTagsForResource' => [ 'name' => 'ListTagsForResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListTagsForResourceRequest', ], 'output' => [ 'shape' => 'ListTagsForResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'RestoreTable' => [ 'name' => 'RestoreTable', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'RestoreTableRequest', ], 'output' => [ 'shape' => 'RestoreTableResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'TagResource' => [ 'name' => 'TagResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'TagResourceRequest', ], 'output' => [ 'shape' => 'TagResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'UntagResource' => [ 'name' => 'UntagResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UntagResourceRequest', ], 'output' => [ 'shape' => 'UntagResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'UpdateTable' => [ 'name' => 'UpdateTable', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateTableRequest', ], 'output' => [ 'shape' => 'UpdateTableResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], ], 'shapes' => [ 'ARN' => [ 'type' => 'string', 'max' => 1000, 'min' => 20, 'pattern' => 'arn:(aws[a-zA-Z0-9-]*):cassandra:.+.*', ], 'AccessDeniedException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'AutoScalingPolicy' => [ 'type' => 'structure', 'members' => [ 'targetTrackingScalingPolicyConfiguration' => [ 'shape' => 'TargetTrackingScalingPolicyConfiguration', ], ], ], 'AutoScalingSettings' => [ 'type' => 'structure', 'members' => [ 'autoScalingDisabled' => [ 'shape' => 'BooleanObject', ], 'minimumUnits' => [ 'shape' => 'CapacityUnits', ], 'maximumUnits' => [ 'shape' => 'CapacityUnits', ], 'scalingPolicy' => [ 'shape' => 'AutoScalingPolicy', ], ], ], 'AutoScalingSpecification' => [ 'type' => 'structure', 'members' => [ 'writeCapacityAutoScaling' => [ 'shape' => 'AutoScalingSettings', ], 'readCapacityAutoScaling' => [ 'shape' => 'AutoScalingSettings', ], ], ], 'BooleanObject' => [ 'type' => 'boolean', ], 'CapacitySpecification' => [ 'type' => 'structure', 'required' => [ 'throughputMode', ], 'members' => [ 'throughputMode' => [ 'shape' => 'ThroughputMode', ], 'readCapacityUnits' => [ 'shape' => 'CapacityUnits', ], 'writeCapacityUnits' => [ 'shape' => 'CapacityUnits', ], ], ], 'CapacitySpecificationSummary' => [ 'type' => 'structure', 'required' => [ 'throughputMode', ], 'members' => [ 'throughputMode' => [ 'shape' => 'ThroughputMode', ], 'readCapacityUnits' => [ 'shape' => 'CapacityUnits', ], 'writeCapacityUnits' => [ 'shape' => 'CapacityUnits', ], 'lastUpdateToPayPerRequestTimestamp' => [ 'shape' => 'Timestamp', ], ], ], 'CapacityUnits' => [ 'type' => 'long', 'box' => true, 'min' => 1, ], 'ClientSideTimestamps' => [ 'type' => 'structure', 'required' => [ 'status', ], 'members' => [ 'status' => [ 'shape' => 'ClientSideTimestampsStatus', ], ], ], 'ClientSideTimestampsStatus' => [ 'type' => 'string', 'enum' => [ 'ENABLED', ], ], 'ClusteringKey' => [ 'type' => 'structure', 'required' => [ 'name', 'orderBy', ], 'members' => [ 'name' => [ 'shape' => 'GenericString', ], 'orderBy' => [ 'shape' => 'SortOrder', ], ], ], 'ClusteringKeyList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ClusteringKey', ], ], 'ColumnDefinition' => [ 'type' => 'structure', 'required' => [ 'name', 'type', ], 'members' => [ 'name' => [ 'shape' => 'GenericString', ], 'type' => [ 'shape' => 'GenericString', ], ], ], 'ColumnDefinitionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ColumnDefinition', ], 'min' => 1, ], 'Comment' => [ 'type' => 'structure', 'required' => [ 'message', ], 'members' => [ 'message' => [ 'shape' => 'String', ], ], ], 'ConflictException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'CreateKeyspaceRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tags' => [ 'shape' => 'TagList', ], 'replicationSpecification' => [ 'shape' => 'ReplicationSpecification', ], ], ], 'CreateKeyspaceResponse' => [ 'type' => 'structure', 'required' => [ 'resourceArn', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], ], ], 'CreateTableRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', 'schemaDefinition', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], 'schemaDefinition' => [ 'shape' => 'SchemaDefinition', ], 'comment' => [ 'shape' => 'Comment', ], 'capacitySpecification' => [ 'shape' => 'CapacitySpecification', ], 'encryptionSpecification' => [ 'shape' => 'EncryptionSpecification', ], 'pointInTimeRecovery' => [ 'shape' => 'PointInTimeRecovery', ], 'ttl' => [ 'shape' => 'TimeToLive', ], 'defaultTimeToLive' => [ 'shape' => 'DefaultTimeToLive', ], 'tags' => [ 'shape' => 'TagList', ], 'clientSideTimestamps' => [ 'shape' => 'ClientSideTimestamps', ], 'autoScalingSpecification' => [ 'shape' => 'AutoScalingSpecification', ], 'replicaSpecifications' => [ 'shape' => 'ReplicaSpecificationList', ], ], ], 'CreateTableResponse' => [ 'type' => 'structure', 'required' => [ 'resourceArn', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], ], ], 'DefaultTimeToLive' => [ 'type' => 'integer', 'box' => true, 'max' => 630720000, 'min' => 0, ], 'DeleteKeyspaceRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], ], ], 'DeleteKeyspaceResponse' => [ 'type' => 'structure', 'members' => [], ], 'DeleteTableRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], ], ], 'DeleteTableResponse' => [ 'type' => 'structure', 'members' => [], ], 'DoubleObject' => [ 'type' => 'double', ], 'EncryptionSpecification' => [ 'type' => 'structure', 'required' => [ 'type', ], 'members' => [ 'type' => [ 'shape' => 'EncryptionType', ], 'kmsKeyIdentifier' => [ 'shape' => 'kmsKeyARN', ], ], ], 'EncryptionType' => [ 'type' => 'string', 'enum' => [ 'CUSTOMER_MANAGED_KMS_KEY', 'AWS_OWNED_KMS_KEY', ], ], 'GenericString' => [ 'type' => 'string', ], 'GetKeyspaceRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], ], ], 'GetKeyspaceResponse' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'resourceArn', 'replicationStrategy', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'resourceArn' => [ 'shape' => 'ARN', ], 'replicationStrategy' => [ 'shape' => 'rs', ], 'replicationRegions' => [ 'shape' => 'RegionList', ], ], ], 'GetTableAutoScalingSettingsRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], ], ], 'GetTableAutoScalingSettingsResponse' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', 'resourceArn', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], 'resourceArn' => [ 'shape' => 'ARN', ], 'autoScalingSpecification' => [ 'shape' => 'AutoScalingSpecification', ], 'replicaSpecifications' => [ 'shape' => 'ReplicaAutoScalingSpecificationList', ], ], ], 'GetTableRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], ], ], 'GetTableResponse' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', 'resourceArn', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], 'resourceArn' => [ 'shape' => 'ARN', ], 'creationTimestamp' => [ 'shape' => 'Timestamp', ], 'status' => [ 'shape' => 'TableStatus', ], 'schemaDefinition' => [ 'shape' => 'SchemaDefinition', ], 'capacitySpecification' => [ 'shape' => 'CapacitySpecificationSummary', ], 'encryptionSpecification' => [ 'shape' => 'EncryptionSpecification', ], 'pointInTimeRecovery' => [ 'shape' => 'PointInTimeRecoverySummary', ], 'ttl' => [ 'shape' => 'TimeToLive', ], 'defaultTimeToLive' => [ 'shape' => 'DefaultTimeToLive', ], 'comment' => [ 'shape' => 'Comment', ], 'clientSideTimestamps' => [ 'shape' => 'ClientSideTimestamps', ], 'replicaSpecifications' => [ 'shape' => 'ReplicaSpecificationSummaryList', ], ], ], 'IntegerObject' => [ 'type' => 'integer', ], 'InternalServerException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], ], 'exception' => true, 'fault' => true, ], 'KeyspaceName' => [ 'type' => 'string', 'max' => 48, 'min' => 1, 'pattern' => '[a-zA-Z0-9][a-zA-Z0-9_]{0,47}', ], 'KeyspaceSummary' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'resourceArn', 'replicationStrategy', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'resourceArn' => [ 'shape' => 'ARN', ], 'replicationStrategy' => [ 'shape' => 'rs', ], 'replicationRegions' => [ 'shape' => 'RegionList', ], ], ], 'KeyspaceSummaryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'KeyspaceSummary', ], ], 'ListKeyspacesRequest' => [ 'type' => 'structure', 'members' => [ 'nextToken' => [ 'shape' => 'NextToken', ], 'maxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListKeyspacesResponse' => [ 'type' => 'structure', 'required' => [ 'keyspaces', ], 'members' => [ 'nextToken' => [ 'shape' => 'NextToken', ], 'keyspaces' => [ 'shape' => 'KeyspaceSummaryList', ], ], ], 'ListTablesRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', ], 'members' => [ 'nextToken' => [ 'shape' => 'NextToken', ], 'maxResults' => [ 'shape' => 'MaxResults', ], 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], ], ], 'ListTablesResponse' => [ 'type' => 'structure', 'members' => [ 'nextToken' => [ 'shape' => 'NextToken', ], 'tables' => [ 'shape' => 'TableSummaryList', ], ], ], 'ListTagsForResourceRequest' => [ 'type' => 'structure', 'required' => [ 'resourceArn', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], 'nextToken' => [ 'shape' => 'NextToken', ], 'maxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListTagsForResourceResponse' => [ 'type' => 'structure', 'members' => [ 'nextToken' => [ 'shape' => 'NextToken', ], 'tags' => [ 'shape' => 'TagList', ], ], ], 'MaxResults' => [ 'type' => 'integer', 'box' => true, 'max' => 1000, 'min' => 1, ], 'NextToken' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, ], 'PartitionKey' => [ 'type' => 'structure', 'required' => [ 'name', ], 'members' => [ 'name' => [ 'shape' => 'GenericString', ], ], ], 'PartitionKeyList' => [ 'type' => 'list', 'member' => [ 'shape' => 'PartitionKey', ], 'min' => 1, ], 'PointInTimeRecovery' => [ 'type' => 'structure', 'required' => [ 'status', ], 'members' => [ 'status' => [ 'shape' => 'PointInTimeRecoveryStatus', ], ], ], 'PointInTimeRecoveryStatus' => [ 'type' => 'string', 'enum' => [ 'ENABLED', 'DISABLED', ], ], 'PointInTimeRecoverySummary' => [ 'type' => 'structure', 'required' => [ 'status', ], 'members' => [ 'status' => [ 'shape' => 'PointInTimeRecoveryStatus', ], 'earliestRestorableTimestamp' => [ 'shape' => 'Timestamp', ], ], ], 'RegionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'region', ], 'max' => 6, 'min' => 2, ], 'ReplicaAutoScalingSpecification' => [ 'type' => 'structure', 'members' => [ 'region' => [ 'shape' => 'region', ], 'autoScalingSpecification' => [ 'shape' => 'AutoScalingSpecification', ], ], ], 'ReplicaAutoScalingSpecificationList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ReplicaAutoScalingSpecification', ], 'min' => 0, ], 'ReplicaSpecification' => [ 'type' => 'structure', 'required' => [ 'region', ], 'members' => [ 'region' => [ 'shape' => 'region', ], 'readCapacityUnits' => [ 'shape' => 'CapacityUnits', ], 'readCapacityAutoScaling' => [ 'shape' => 'AutoScalingSettings', ], ], ], 'ReplicaSpecificationList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ReplicaSpecification', ], 'min' => 1, ], 'ReplicaSpecificationSummary' => [ 'type' => 'structure', 'members' => [ 'region' => [ 'shape' => 'region', ], 'status' => [ 'shape' => 'TableStatus', ], 'capacitySpecification' => [ 'shape' => 'CapacitySpecificationSummary', ], ], ], 'ReplicaSpecificationSummaryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ReplicaSpecificationSummary', ], 'min' => 0, ], 'ReplicationSpecification' => [ 'type' => 'structure', 'required' => [ 'replicationStrategy', ], 'members' => [ 'replicationStrategy' => [ 'shape' => 'rs', ], 'regionList' => [ 'shape' => 'RegionList', ], ], ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], 'resourceArn' => [ 'shape' => 'ARN', ], ], 'exception' => true, ], 'RestoreTableRequest' => [ 'type' => 'structure', 'required' => [ 'sourceKeyspaceName', 'sourceTableName', 'targetKeyspaceName', 'targetTableName', ], 'members' => [ 'sourceKeyspaceName' => [ 'shape' => 'KeyspaceName', ], 'sourceTableName' => [ 'shape' => 'TableName', ], 'targetKeyspaceName' => [ 'shape' => 'KeyspaceName', ], 'targetTableName' => [ 'shape' => 'TableName', ], 'restoreTimestamp' => [ 'shape' => 'Timestamp', ], 'capacitySpecificationOverride' => [ 'shape' => 'CapacitySpecification', ], 'encryptionSpecificationOverride' => [ 'shape' => 'EncryptionSpecification', ], 'pointInTimeRecoveryOverride' => [ 'shape' => 'PointInTimeRecovery', ], 'tagsOverride' => [ 'shape' => 'TagList', ], 'autoScalingSpecification' => [ 'shape' => 'AutoScalingSpecification', ], 'replicaSpecifications' => [ 'shape' => 'ReplicaSpecificationList', ], ], ], 'RestoreTableResponse' => [ 'type' => 'structure', 'required' => [ 'restoredTableARN', ], 'members' => [ 'restoredTableARN' => [ 'shape' => 'ARN', ], ], ], 'SchemaDefinition' => [ 'type' => 'structure', 'required' => [ 'allColumns', 'partitionKeys', ], 'members' => [ 'allColumns' => [ 'shape' => 'ColumnDefinitionList', ], 'partitionKeys' => [ 'shape' => 'PartitionKeyList', ], 'clusteringKeys' => [ 'shape' => 'ClusteringKeyList', ], 'staticColumns' => [ 'shape' => 'StaticColumnList', ], ], ], 'ServiceQuotaExceededException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'SortOrder' => [ 'type' => 'string', 'enum' => [ 'ASC', 'DESC', ], ], 'StaticColumn' => [ 'type' => 'structure', 'required' => [ 'name', ], 'members' => [ 'name' => [ 'shape' => 'GenericString', ], ], ], 'StaticColumnList' => [ 'type' => 'list', 'member' => [ 'shape' => 'StaticColumn', ], ], 'String' => [ 'type' => 'string', ], 'TableName' => [ 'type' => 'string', 'max' => 48, 'min' => 1, 'pattern' => '[a-zA-Z0-9][a-zA-Z0-9_]{0,47}', ], 'TableStatus' => [ 'type' => 'string', 'enum' => [ 'ACTIVE', 'CREATING', 'UPDATING', 'DELETING', 'DELETED', 'RESTORING', 'INACCESSIBLE_ENCRYPTION_CREDENTIALS', ], ], 'TableSummary' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', 'resourceArn', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], 'resourceArn' => [ 'shape' => 'ARN', ], ], ], 'TableSummaryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'TableSummary', ], ], 'Tag' => [ 'type' => 'structure', 'required' => [ 'key', 'value', ], 'members' => [ 'key' => [ 'shape' => 'TagKey', ], 'value' => [ 'shape' => 'TagValue', ], ], ], 'TagKey' => [ 'type' => 'string', 'max' => 128, 'min' => 1, ], 'TagList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Tag', ], 'max' => 60, 'min' => 1, ], 'TagResourceRequest' => [ 'type' => 'structure', 'required' => [ 'resourceArn', 'tags', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], 'tags' => [ 'shape' => 'TagList', ], ], ], 'TagResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'TagValue' => [ 'type' => 'string', 'max' => 256, 'min' => 1, ], 'TargetTrackingScalingPolicyConfiguration' => [ 'type' => 'structure', 'required' => [ 'targetValue', ], 'members' => [ 'disableScaleIn' => [ 'shape' => 'BooleanObject', ], 'scaleInCooldown' => [ 'shape' => 'IntegerObject', ], 'scaleOutCooldown' => [ 'shape' => 'IntegerObject', ], 'targetValue' => [ 'shape' => 'DoubleObject', ], ], ], 'ThroughputMode' => [ 'type' => 'string', 'enum' => [ 'PAY_PER_REQUEST', 'PROVISIONED', ], ], 'TimeToLive' => [ 'type' => 'structure', 'required' => [ 'status', ], 'members' => [ 'status' => [ 'shape' => 'TimeToLiveStatus', ], ], ], 'TimeToLiveStatus' => [ 'type' => 'string', 'enum' => [ 'ENABLED', ], ], 'Timestamp' => [ 'type' => 'timestamp', ], 'UntagResourceRequest' => [ 'type' => 'structure', 'required' => [ 'resourceArn', 'tags', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], 'tags' => [ 'shape' => 'TagList', ], ], ], 'UntagResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'UpdateTableRequest' => [ 'type' => 'structure', 'required' => [ 'keyspaceName', 'tableName', ], 'members' => [ 'keyspaceName' => [ 'shape' => 'KeyspaceName', ], 'tableName' => [ 'shape' => 'TableName', ], 'addColumns' => [ 'shape' => 'ColumnDefinitionList', ], 'capacitySpecification' => [ 'shape' => 'CapacitySpecification', ], 'encryptionSpecification' => [ 'shape' => 'EncryptionSpecification', ], 'pointInTimeRecovery' => [ 'shape' => 'PointInTimeRecovery', ], 'ttl' => [ 'shape' => 'TimeToLive', ], 'defaultTimeToLive' => [ 'shape' => 'DefaultTimeToLive', ], 'clientSideTimestamps' => [ 'shape' => 'ClientSideTimestamps', ], 'autoScalingSpecification' => [ 'shape' => 'AutoScalingSpecification', ], 'replicaSpecifications' => [ 'shape' => 'ReplicaSpecificationList', ], ], ], 'UpdateTableResponse' => [ 'type' => 'structure', 'required' => [ 'resourceArn', ], 'members' => [ 'resourceArn' => [ 'shape' => 'ARN', ], ], ], 'ValidationException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'kmsKeyARN' => [ 'type' => 'string', 'max' => 5096, 'min' => 1, ], 'region' => [ 'type' => 'string', 'max' => 25, 'min' => 2, ], 'rs' => [ 'type' => 'string', 'enum' => [ 'SINGLE_REGION', 'MULTI_REGION', ], 'max' => 20, 'min' => 1, ], ],];