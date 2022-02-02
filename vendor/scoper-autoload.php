<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('AutoloadIncluder', false) && !interface_exists('AutoloadIncluder', false) && !trait_exists('AutoloadIncluder', false)) {
    spl_autoload_call('RectorPrefix20220202\AutoloadIncluder');
}
if (!class_exists('ComposerAutoloaderInita9432eadaa336def2b08e78cb934fdfe', false) && !interface_exists('ComposerAutoloaderInita9432eadaa336def2b08e78cb934fdfe', false) && !trait_exists('ComposerAutoloaderInita9432eadaa336def2b08e78cb934fdfe', false)) {
    spl_autoload_call('RectorPrefix20220202\ComposerAutoloaderInita9432eadaa336def2b08e78cb934fdfe');
}
if (!class_exists('Helmich\TypoScriptParser\Parser\AST\Statement', false) && !interface_exists('Helmich\TypoScriptParser\Parser\AST\Statement', false) && !trait_exists('Helmich\TypoScriptParser\Parser\AST\Statement', false)) {
    spl_autoload_call('RectorPrefix20220202\Helmich\TypoScriptParser\Parser\AST\Statement');
}
if (!class_exists('Helmich\TypoScriptParser\Parser\Traverser\Traverser', false) && !interface_exists('Helmich\TypoScriptParser\Parser\Traverser\Traverser', false) && !trait_exists('Helmich\TypoScriptParser\Parser\Traverser\Traverser', false)) {
    spl_autoload_call('RectorPrefix20220202\Helmich\TypoScriptParser\Parser\Traverser\Traverser');
}
if (!class_exists('MissingReturnTypeParser', false) && !interface_exists('MissingReturnTypeParser', false) && !trait_exists('MissingReturnTypeParser', false)) {
    spl_autoload_call('RectorPrefix20220202\MissingReturnTypeParser');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('RectorPrefix20220202\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('RectorPrefix20220202\Normalizer');
}
if (!class_exists('Attribute', false) && !interface_exists('Attribute', false) && !trait_exists('Attribute', false)) {
    spl_autoload_call('RectorPrefix20220202\Attribute');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('RectorPrefix20220202\Stringable');
}
if (!class_exists('UnhandledMatchError', false) && !interface_exists('UnhandledMatchError', false) && !trait_exists('UnhandledMatchError', false)) {
    spl_autoload_call('RectorPrefix20220202\UnhandledMatchError');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('RectorPrefix20220202\ValueError');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('RectorPrefix20220202\ReturnTypeWillChange');
}
if (!class_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJson', false) && !interface_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJson', false) && !trait_exists('Symplify\ComposerJsonManipulator\ValueObject\ComposerJson', false)) {
    spl_autoload_call('RectorPrefix20220202\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson');
}
if (!class_exists('Symplify\SmartFileSystem\SmartFileInfo', false) && !interface_exists('Symplify\SmartFileSystem\SmartFileInfo', false) && !trait_exists('Symplify\SmartFileSystem\SmartFileInfo', false)) {
    spl_autoload_call('RectorPrefix20220202\Symplify\SmartFileSystem\SmartFileInfo');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('dump_with_depth')) {
    function dump_with_depth() {
        return \RectorPrefix20220202\dump_with_depth(...func_get_args());
    }
}
if (!function_exists('dn')) {
    function dn() {
        return \RectorPrefix20220202\dn(...func_get_args());
    }
}
if (!function_exists('dump_node')) {
    function dump_node() {
        return \RectorPrefix20220202\dump_node(...func_get_args());
    }
}
if (!function_exists('print_node')) {
    function print_node() {
        return \RectorPrefix20220202\print_node(...func_get_args());
    }
}
if (!function_exists('composerRequirea9432eadaa336def2b08e78cb934fdfe')) {
    function composerRequirea9432eadaa336def2b08e78cb934fdfe() {
        return \RectorPrefix20220202\composerRequirea9432eadaa336def2b08e78cb934fdfe(...func_get_args());
    }
}
if (!function_exists('scanPath')) {
    function scanPath() {
        return \RectorPrefix20220202\scanPath(...func_get_args());
    }
}
if (!function_exists('lintFile')) {
    function lintFile() {
        return \RectorPrefix20220202\lintFile(...func_get_args());
    }
}
if (!function_exists('parseArgs')) {
    function parseArgs() {
        return \RectorPrefix20220202\parseArgs(...func_get_args());
    }
}
if (!function_exists('showHelp')) {
    function showHelp() {
        return \RectorPrefix20220202\showHelp(...func_get_args());
    }
}
if (!function_exists('formatErrorMessage')) {
    function formatErrorMessage() {
        return \RectorPrefix20220202\formatErrorMessage(...func_get_args());
    }
}
if (!function_exists('preprocessGrammar')) {
    function preprocessGrammar() {
        return \RectorPrefix20220202\preprocessGrammar(...func_get_args());
    }
}
if (!function_exists('resolveNodes')) {
    function resolveNodes() {
        return \RectorPrefix20220202\resolveNodes(...func_get_args());
    }
}
if (!function_exists('resolveMacros')) {
    function resolveMacros() {
        return \RectorPrefix20220202\resolveMacros(...func_get_args());
    }
}
if (!function_exists('resolveStackAccess')) {
    function resolveStackAccess() {
        return \RectorPrefix20220202\resolveStackAccess(...func_get_args());
    }
}
if (!function_exists('magicSplit')) {
    function magicSplit() {
        return \RectorPrefix20220202\magicSplit(...func_get_args());
    }
}
if (!function_exists('assertArgs')) {
    function assertArgs() {
        return \RectorPrefix20220202\assertArgs(...func_get_args());
    }
}
if (!function_exists('removeTrailingWhitespace')) {
    function removeTrailingWhitespace() {
        return \RectorPrefix20220202\removeTrailingWhitespace(...func_get_args());
    }
}
if (!function_exists('regex')) {
    function regex() {
        return \RectorPrefix20220202\regex(...func_get_args());
    }
}
if (!function_exists('execCmd')) {
    function execCmd() {
        return \RectorPrefix20220202\execCmd(...func_get_args());
    }
}
if (!function_exists('ensureDirExists')) {
    function ensureDirExists() {
        return \RectorPrefix20220202\ensureDirExists(...func_get_args());
    }
}
if (!function_exists('uv_signal_init')) {
    function uv_signal_init() {
        return \RectorPrefix20220202\uv_signal_init(...func_get_args());
    }
}
if (!function_exists('uv_signal_start')) {
    function uv_signal_start() {
        return \RectorPrefix20220202\uv_signal_start(...func_get_args());
    }
}
if (!function_exists('uv_poll_init_socket')) {
    function uv_poll_init_socket() {
        return \RectorPrefix20220202\uv_poll_init_socket(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \RectorPrefix20220202\setproctitle(...func_get_args());
    }
}
if (!function_exists('trigger_deprecation')) {
    function trigger_deprecation() {
        return \RectorPrefix20220202\trigger_deprecation(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \RectorPrefix20220202\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \RectorPrefix20220202\enum_exists(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \RectorPrefix20220202\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \RectorPrefix20220202\dump(...func_get_args());
    }
}
if (!function_exists('dumpe')) {
    function dumpe() {
        return \RectorPrefix20220202\dumpe(...func_get_args());
    }
}
if (!function_exists('bdump')) {
    function bdump() {
        return \RectorPrefix20220202\bdump(...func_get_args());
    }
}
if (!function_exists('compressJs')) {
    function compressJs() {
        return \RectorPrefix20220202\compressJs(...func_get_args());
    }
}
if (!function_exists('compressCss')) {
    function compressCss() {
        return \RectorPrefix20220202\compressCss(...func_get_args());
    }
}

return $loader;
