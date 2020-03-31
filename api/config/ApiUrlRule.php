<?php

namespace api\config;

use yii\web\CompositeUrlRule;
use yii\web\UrlRuleInterface;
use yii\base\InvalidConfigException;

class ApiUrlRule extends CompositeUrlRule
{
    public $ruleConfig = ['class' => 'yii\web\UrlRule'];

    protected $rules = [
        [
            'pattern' => 'api',
            'route' => 'site/index',
        ],
        [
            'pattern' => 'api/profile',
            'route' => 'user/profile/index',
        ],
        [
            'pattern' => 'api/oauth2/<_a:\w+>',
            'route' => 'oauth2/rest/<_a>',
            'method' => 'POST',
        ],
        [
            'pattern' => 'api/<_ver:v(\d+)>/books',
            'route' => '<_ver>/library/book/index',
        ],
        [
            'pattern' => 'api/<_ver:v(\d+)>/books/<id:\d+>',
            'route' => '<_ver>/library/book/options',
            'method' => 'OPTIONS',
        ],
        [
            'pattern' => 'api/<_ver:v(\d+)>/books/<id:\d+>',
            'route' => '<_ver>/library/book/view',
        ],
        [
            'pattern' => 'api/<_ver:v(\d+)>/books/<id:\d+>',
            'route' => '<_ver>/library/book/update',
            'method' => 'PUT',
        ],
        [
            'pattern' => 'api/<_ver:v(\d+)>/books/<id:\d+>',
            'route' => '<_ver>/library/book/delete',
            'method' => 'DELETE',
        ],
    ];

    /**
     * Creates the URL rules that should be contained within this composite rule.
     *
     * @return UrlRuleInterface[] the URL rules
     * @throws InvalidConfigException
     */
    protected function createRules()
    {
        $rules = [];

        foreach ($this->rules as $rule) {
            $item = \Yii::createObject(
                array_merge(
                    $this->ruleConfig,
                    [
                        'pattern' => $rule['pattern'],
                        'route' => $rule['route'],
                        'verb' => [$rule['method'] ?? 'GET'],
                    ]
                )
            );

            if (!$item instanceof UrlRuleInterface) {
                throw new InvalidConfigException('URL rule class must implement UrlRuleInterface.');
            }

            $rules[] = $item;
        }

        return $rules;
    }
}
