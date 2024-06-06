<?php
// This file was auto-generated from sdk-root/src/data/bedrock-runtime/2023-09-30/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2023-09-30', 'endpointPrefix' => 'bedrock-runtime', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceFullName' => 'Amazon Bedrock Runtime', 'serviceId' => 'Bedrock Runtime', 'signatureVersion' => 'v4', 'signingName' => 'bedrock', 'uid' => 'bedrock-runtime-2023-09-30', ], 'operations' => [ 'InvokeModel' => [ 'name' => 'InvokeModel', 'http' => [ 'method' => 'POST', 'requestUri' => '/model/{modelId}/invoke', 'responseCode' => 200, ], 'input' => [ 'shape' => 'InvokeModelRequest', ], 'output' => [ 'shape' => 'InvokeModelResponse', ], 'errors' => [ [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ThrottlingException', ], [ 'shape' => 'ModelTimeoutException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ModelNotReadyException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'ModelErrorException', ], ], ], 'InvokeModelWithResponseStream' => [ 'name' => 'InvokeModelWithResponseStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/model/{modelId}/invoke-with-response-stream', 'responseCode' => 200, ], 'input' => [ 'shape' => 'InvokeModelWithResponseStreamRequest', ], 'output' => [ 'shape' => 'InvokeModelWithResponseStreamResponse', ], 'errors' => [ [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ThrottlingException', ], [ 'shape' => 'ModelTimeoutException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ModelStreamErrorException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ModelNotReadyException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'ModelErrorException', ], ], ], ], 'shapes' => [ 'AccessDeniedException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 403, 'senderFault' => true, ], 'exception' => true, ], 'Body' => [ 'type' => 'blob', 'max' => 25000000, 'min' => 0, 'sensitive' => true, ], 'InternalServerException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 500, ], 'exception' => true, 'fault' => true, ], 'InvokeModelIdentifier' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => '(arn:aws(-[^:]+)?:bedrock:[a-z0-9-]{1,20}:(([0-9]{12}:custom-model/[a-z0-9-]{1,63}[.]{1}[a-z0-9-]{1,63}/[a-z0-9]{12})|(:foundation-model/[a-z0-9-]{1,63}[.]{1}[a-z0-9-]{1,63}([.:]?[a-z0-9-]{1,63}))|([0-9]{12}:provisioned-model/[a-z0-9]{12})))|([a-z0-9-]{1,63}[.]{1}[a-z0-9-]{1,63}([.:]?[a-z0-9-]{1,63}))|(([0-9a-zA-Z][_-]?)+)', ], 'InvokeModelRequest' => [ 'type' => 'structure', 'required' => [ 'body', 'modelId', ], 'members' => [ 'body' => [ 'shape' => 'Body', ], 'contentType' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'Content-Type', ], 'accept' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'Accept', ], 'modelId' => [ 'shape' => 'InvokeModelIdentifier', 'location' => 'uri', 'locationName' => 'modelId', ], ], 'payload' => 'body', ], 'InvokeModelResponse' => [ 'type' => 'structure', 'required' => [ 'body', 'contentType', ], 'members' => [ 'body' => [ 'shape' => 'Body', ], 'contentType' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'Content-Type', ], ], 'payload' => 'body', ], 'InvokeModelWithResponseStreamRequest' => [ 'type' => 'structure', 'required' => [ 'body', 'modelId', ], 'members' => [ 'body' => [ 'shape' => 'Body', ], 'contentType' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'Content-Type', ], 'accept' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'X-Amzn-Bedrock-Accept', ], 'modelId' => [ 'shape' => 'InvokeModelIdentifier', 'location' => 'uri', 'locationName' => 'modelId', ], ], 'payload' => 'body', ], 'InvokeModelWithResponseStreamResponse' => [ 'type' => 'structure', 'required' => [ 'body', 'contentType', ], 'members' => [ 'body' => [ 'shape' => 'ResponseStream', ], 'contentType' => [ 'shape' => 'MimeType', 'location' => 'header', 'locationName' => 'X-Amzn-Bedrock-Content-Type', ], ], 'payload' => 'body', ], 'MimeType' => [ 'type' => 'string', ], 'ModelErrorException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], 'originalStatusCode' => [ 'shape' => 'StatusCode', ], 'resourceName' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 424, 'senderFault' => true, ], 'exception' => true, ], 'ModelNotReadyException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 429, 'senderFault' => true, ], 'exception' => true, ], 'ModelStreamErrorException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], 'originalStatusCode' => [ 'shape' => 'StatusCode', ], 'originalMessage' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 424, 'senderFault' => true, ], 'exception' => true, ], 'ModelTimeoutException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 408, 'senderFault' => true, ], 'exception' => true, ], 'NonBlankString' => [ 'type' => 'string', 'pattern' => '[\\s\\S]*', ], 'PartBody' => [ 'type' => 'blob', 'max' => 1000000, 'min' => 0, 'sensitive' => true, ], 'PayloadPart' => [ 'type' => 'structure', 'members' => [ 'bytes' => [ 'shape' => 'PartBody', ], ], 'event' => true, 'sensitive' => true, ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 404, 'senderFault' => true, ], 'exception' => true, ], 'ResponseStream' => [ 'type' => 'structure', 'members' => [ 'chunk' => [ 'shape' => 'PayloadPart', ], 'internalServerException' => [ 'shape' => 'InternalServerException', ], 'modelStreamErrorException' => [ 'shape' => 'ModelStreamErrorException', ], 'validationException' => [ 'shape' => 'ValidationException', ], 'throttlingException' => [ 'shape' => 'ThrottlingException', ], 'modelTimeoutException' => [ 'shape' => 'ModelTimeoutException', ], ], 'eventstream' => true, ], 'ServiceQuotaExceededException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], 'StatusCode' => [ 'type' => 'integer', 'box' => true, 'max' => 599, 'min' => 100, ], 'ThrottlingException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 429, 'senderFault' => true, ], 'exception' => true, ], 'ValidationException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'NonBlankString', ], ], 'error' => [ 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], ],];