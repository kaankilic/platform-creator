<?php 
namespace Kaankilic\PlatformCreator\Commands;
/**
 * Class GetEnvironmentFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetEnv
{
    /**
     * Handle the command.
     *
     * @param Application $application
     * @return string
     */
    public function handle()
    {
		return base_path('.env');
    }
}
