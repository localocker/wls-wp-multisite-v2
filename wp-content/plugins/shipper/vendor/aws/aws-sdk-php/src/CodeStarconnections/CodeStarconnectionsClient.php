<?php
namespace Aws\CodeStarconnections;

use Aws\AwsClient;

/**
 * This client is used to interact with the **AWS CodeStar connections** service.
 * @method \Aws\Result createConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createConnectionAsync(array $args = [])
 * @method \Aws\Result createHost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createHostAsync(array $args = [])
 * @method \Aws\Result createRepositoryLink(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createRepositoryLinkAsync(array $args = [])
 * @method \Aws\Result createSyncConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createSyncConfigurationAsync(array $args = [])
 * @method \Aws\Result deleteConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConnectionAsync(array $args = [])
 * @method \Aws\Result deleteHost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteHostAsync(array $args = [])
 * @method \Aws\Result deleteRepositoryLink(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteRepositoryLinkAsync(array $args = [])
 * @method \Aws\Result deleteSyncConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteSyncConfigurationAsync(array $args = [])
 * @method \Aws\Result getConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getConnectionAsync(array $args = [])
 * @method \Aws\Result getHost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getHostAsync(array $args = [])
 * @method \Aws\Result getRepositoryLink(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getRepositoryLinkAsync(array $args = [])
 * @method \Aws\Result getRepositorySyncStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getRepositorySyncStatusAsync(array $args = [])
 * @method \Aws\Result getResourceSyncStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getResourceSyncStatusAsync(array $args = [])
 * @method \Aws\Result getSyncBlockerSummary(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSyncBlockerSummaryAsync(array $args = [])
 * @method \Aws\Result getSyncConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSyncConfigurationAsync(array $args = [])
 * @method \Aws\Result listConnections(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listConnectionsAsync(array $args = [])
 * @method \Aws\Result listHosts(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listHostsAsync(array $args = [])
 * @method \Aws\Result listRepositoryLinks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listRepositoryLinksAsync(array $args = [])
 * @method \Aws\Result listRepositorySyncDefinitions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listRepositorySyncDefinitionsAsync(array $args = [])
 * @method \Aws\Result listSyncConfigurations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listSyncConfigurationsAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateHost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateHostAsync(array $args = [])
 * @method \Aws\Result updateRepositoryLink(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateRepositoryLinkAsync(array $args = [])
 * @method \Aws\Result updateSyncBlocker(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateSyncBlockerAsync(array $args = [])
 * @method \Aws\Result updateSyncConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateSyncConfigurationAsync(array $args = [])
 */
class CodeStarconnectionsClient extends AwsClient {}