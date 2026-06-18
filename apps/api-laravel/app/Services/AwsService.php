<?php

namespace App\Services;

use Aws\CloudFormation\CloudFormationClient;
use Aws\Credentials\Credentials;
use Aws\Route53\Route53Client;

class AwsService
{
    public function upsertRoute53Record(string $subdomain): void
    {
        $credentials = new Credentials(
            config('services.aws.access_key'),
            config('services.aws.secret_access_key')
        );

        $cloudFormationClient = new CloudFormationClient([
            'region' => config('services.aws.default_region'),
            'credentials' => $credentials
        ]);

        $stack = $cloudFormationClient->describeStacks(['StackName' => 'InfrastructureStack']);
        $outputs = $stack->toArray()['Stacks'][0]['Outputs'];

        $loadBalancerDNS = '';
        $loadBalancerHostedZoneID = '';
        foreach ($outputs as $output) {
            if ($output['OutputKey'] === 'LoadBalancerDNS') {
                $loadBalancerDNS = $output['OutputValue'];
            }
            if ($output['OutputKey'] === 'LoadBalancerHostedZoneID') {
                $loadBalancerHostedZoneID = $output['OutputValue'];
            }
        }

        $route53 = new Route53Client([
            'region' => config('services.aws.default_region'),
            'credentials' => $credentials
        ]);

        $route53->changeResourceRecordSets([
            'HostedZoneId' => config('services.aws.site_hosted_zone_id'),
            'ChangeBatch' => [
                'Comment' => 'Creating Alias resource record sets in Route 53',
                'Changes' => [
                    [
                        'Action' => 'UPSERT',
                        'ResourceRecordSet' => [
                            'Name' => $subdomain . config('bookisia.site_domain'),
                            'Type' => 'A',
                            'AliasTarget' => [
                                'DNSName' => "dualstack.$loadBalancerDNS",
                                'EvaluateTargetHealth' => false,
                                'HostedZoneId' => $loadBalancerHostedZoneID,
                            ],
                        ]
                    ]
                ]
            ]
        ]);
    }
}
