<?php

/**

 * @file
 * Contains \Drupal\ddlf\Form\ddlForm.
 *
 */
namespace Drupal\ddlf\Form;

use DrupalCoreFormFormBase;
use DrupalCoreFormFormStateInterface;
use DrupalCoreAjaxAjaxResponse;


/**

 * Class ddlForm.
 *
 * @package Drupal\ddlf\Form
 */
class ddlForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'ddlf_form';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state) {

        $options = [
            'node' => 'Node',
            'user' => 'User'
        ];
        $form['first_field'] = [
            '#type' => 'select',
            '#title' => t('First field'),
            '#options' => $options,
            '#ajax' => [
                'callback' => [$this, 'changeOptionsSecondAjax'],
                'wrapper' => 'second_field_wrapper',
            ],
        ];
        $form['second_field'] = [
            '#type' => 'select',
            '#title' => t('Second field'),
            '#options' => $this->getOptionsSecond($form_state),
            '#ajax' => [
                'callback' => [$this, 'changeOptionsThreeAjax'],
                'wrapper' => 'three_field_wrapper',
            ],
            '#prefix' => '<div id="second_field_wrapper">',
            '#suffix' => '</div>',
        ];

        $form['three_field'] = [
            '#type' => 'select',
            '#title' => t('Three field'),
            '#options' => $this->getOptionsThree($form_state),
            '#prefix' => '<div id="three_field_wrapper">',
            '#suffix' => '</div>',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit',
        ];
        return $form;

    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

    }

    public function changeOptionsSecondAjax(array &$form, FormStateInterface $form_state) {

        return $form['second_field'];

    }

    public function changeOptionsThreeAjax(array &$form, FormStateInterface $form_state) {

        return $form['three_field'];

    }

    public function getOptionsSecond(FormStateInterface $form_state) {
        if ($form_state->getValue('first_field') == 'user') {
            $options = [
                'admin' => 'Admin',
                'manager' => 'Manager'
            ];
        }
        else {
            $options = [
                'article' => 'Article',
                'basic_page' => 'Basic page'
            ];
        }
        return $options;
    }

    public function getOptionsThree(FormStateInterface $form_state) {
        if ($form_state->getValue('second_field') == 'admin') {
            $options = [
                'a' => 'A',
                'b' => 'B'
            ];
        }
        else if ($form_state->getValue('second_field') == 'manager') {
            $options = [
                'c' => 'C',
                'd' => 'D'
            ];
        }
        else {
            $options = [];
        }
        return $options;
    }
}