<?php

/*
 * This file is part of the package ucph_content_quote.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * University of Copenhagen.
 */
declare(strict_types=1);
defined('TYPO3') or die();

call_user_func(function ($extKey ='ucph_content_quote', $contentType ='ucph_content_quote') {
    // Adds the content element to the "Type" dropdown
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_quote_title',
            $contentType,
            // icon identifier
            'ucph_content_quote_icon',
        ],
        'ucph_ce_text',
        'after'
    );

    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }

    // Configure the default backend fields for the content element
    $GLOBALS['TCA']['tt_content']['types'][$contentType] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types'][$contentType],
        [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
                tx_ucph_content_quote_link;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_link,
                tx_ucph_content_quote_source;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_source,
                bodytext;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_quote_text,
                tx_ucph_content_quote_alignment;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_alignment,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
         ',
        ]
    );

    // Register fields
    $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['columns'],
        [
            'tx_ucph_content_quote_source' => [
                'exclude' => true,
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_source',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255
                ]
            ],
            'tx_ucph_content_quote_link' => [
                'exclude' => true,
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_link',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 50,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_link',
                            ],
                        ],
                    ],
                    'softref' => 'typolink'
                ]
            ],
            'tx_ucph_content_quote_alignment' => [
                'exclude' => true,
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_alignment',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_alignment_left', '', 'EXT:'.$extKey.'/Resources/Public/Icons/justify-left.svg'
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_alignment_center',
                            'text-center', 'EXT:'.$extKey.'/Resources/Public/Icons/justify.svg'
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_tx_ucph_content_quote_alignment_right',
                            'text-end', 'EXT:'.$extKey.'/Resources/Public/Icons/justify-right.svg'
                        ]
                    ],
                ],
                'default' => '',
            ],
        ]
    );
});
