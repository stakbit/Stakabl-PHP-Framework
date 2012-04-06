<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once($aConfig['frameworkUrl'] .'StakLoader.php');
StakLoader::autoloadBase($aConfig);
StakConfig::set($aConfig);
StakRouter::getInstance()->route();
//echo (StakConfig::getInstance()->get('benchmark')) ? 'Total memory usage: ' . StakBenchmark::getMemoryUsage() : FALSE;
