<?php
namespace Aws\B2bi;

use Aws\AwsClient;

/**
 * This client is used to interact with the **AWS B2B Data Interchange** service.
 * @method \Aws\Result createCapability(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCapabilityAsync(array $args = [])
 * @method \Aws\Result createPartnership(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createPartnershipAsync(array $args = [])
 * @method \Aws\Result createProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createProfileAsync(array $args = [])
 * @method \Aws\Result createTransformer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createTransformerAsync(array $args = [])
 * @method \Aws\Result deleteCapability(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCapabilityAsync(array $args = [])
 * @method \Aws\Result deletePartnership(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deletePartnershipAsync(array $args = [])
 * @method \Aws\Result deleteProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteProfileAsync(array $args = [])
 * @method \Aws\Result deleteTransformer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteTransformerAsync(array $args = [])
 * @method \Aws\Result getCapability(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCapabilityAsync(array $args = [])
 * @method \Aws\Result getPartnership(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getPartnershipAsync(array $args = [])
 * @method \Aws\Result getProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getProfileAsync(array $args = [])
 * @method \Aws\Result getTransformer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTransformerAsync(array $args = [])
 * @method \Aws\Result getTransformerJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTransformerJobAsync(array $args = [])
 * @method \Aws\Result listCapabilities(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCapabilitiesAsync(array $args = [])
 * @method \Aws\Result listPartnerships(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listPartnershipsAsync(array $args = [])
 * @method \Aws\Result listProfiles(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listProfilesAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result listTransformers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTransformersAsync(array $args = [])
 * @method \Aws\Result startTransformerJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startTransformerJobAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result testMapping(array $args = [])
 * @method \GuzzleHttp\Promise\Promise testMappingAsync(array $args = [])
 * @method \Aws\Result testParsing(array $args = [])
 * @method \GuzzleHttp\Promise\Promise testParsingAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateCapability(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCapabilityAsync(array $args = [])
 * @method \Aws\Result updatePartnership(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updatePartnershipAsync(array $args = [])
 * @method \Aws\Result updateProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateProfileAsync(array $args = [])
 * @method \Aws\Result updateTransformer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTransformerAsync(array $args = [])
 */
class B2biClient extends AwsClient {}