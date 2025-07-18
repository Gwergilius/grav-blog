<?php
namespace Grav\Plugin;

require __DIR__ . '/vendor/autoload.php';

use Grav\Common\Config\Config;
use Grav\Common\Plugin;
use Grav\Common\Utils;
use RocketTheme\Toolbox\Event\Event;
use Dotenv\Dotenv;

/**
 * Forked from https://github.com/Ralla/grav-plugin-dotenv
 * 
 * Class DotenvPlugin
 * @package Grav\Plugin
 */
class DotenvPlugin extends Plugin
{
    /**
     * DotEnv
     *
     * @var dotenv
     */
    private $dotenv;

    /**
     * Subscribed events.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 100],
        ];
    }

    /**
     * Initialize hook.
     */
    public function onPluginsInitialized()
    {
        $filename = $this->grav['config']->get('plugins.dotenv.filename');
        $this->dotenv = Dotenv::createUnsafeImmutable(GRAV_ROOT, $filename ?? '.gravenv');

        try {
            $this->init();
        } catch (\Exception $exception) {
            $message = 'DotEnv: ' . $exception->getMessage();

            $this->grav['debugger']->addMessage($message);

            if ($this->isAdmin()) {
                $this->grav['admin']->setMessage($message, 'warning');
            }
        }
    }

    /**
     * Init all environment settings from env file
     */
    protected function init(): void
    {
        /** @var Config $config */
        $config = $this->grav['config'];
        $data = $this->dotenv->safeLoad();

        $normalized = $this->normalizeData($data);
        $env_data = Utils::arrayUnflattenDotNotation($normalized, '.');
        $config->merge($env_data);
    }

    /**
     * @param array $data
     * @return array
     */
    protected function normalizeData(array $data): array
    {
        foreach ($data as $key => $value) {
            $k = $key;
            if (Utils::contains($k, '_')) {
                $k = str_replace('_', '-', $k);   # Underscore '_' is converted to dash '-' 
                $k = str_replace('--', '_', $k);  # but double underscore is converted to underscore
                unset($data[$key]);
                $data[$k] = $value;
            }

            if (in_array($value, ['false', 'true', 'null']) || is_numeric($value)) {
                $data[$k] = json_decode($value);
            }
        }
        return $data;
    }
}
