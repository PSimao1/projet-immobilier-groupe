<?php
    $finder=PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/tests')
        ->name('*.php')
        ->exclude('vendor')
        ->ignoreDotFiles(true)
        ->ignoreVCS(true)
    ;

    return (new PhpCsFixer\Config())
        ->setRiskyAllowed(false)
        ->setRules([
            '@PSR12'=> true, 
            'array_syntax' =>['syntax'=>'short'],
            'no_unused_imports' => true,
            'binary_operator_spaces' => true,
            'single_quote' => true,
            'blank_line_before_statement' => ['statements'=>['return']],
            'no_trailing_whitespace' => true,
            'no_extra_blank_lines' => ['tokens'=>['extra']],
        ])
        ->setFinder($finder);