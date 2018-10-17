<?php
/**
 * Based on zf-twitter-bootstrap
 *
 * Copyright (c) 2012-2013 Sebastian Hoitz, komola GmbH hoitz@komola.de
 * See other contributors in https://github.com/lciolecki/zf-twitter-bootstrap
 * Licence MIT
 */

/**
 * Class Twitter_Form_Redecorate
 *
 * @todo Manage inline display with sr-only.
 *
 * Adaptation of Twitter_Form to convert an Omeka Form via the theme only.
 */
class Twitter_Form_Redecorate
{
    /**
     * Twitter form types definitions
     */
    const FORM_TYPE_BASIC = 'basic';
    const FORM_TYPE_INLINE = 'inline';
    const FORM_TYPE_HORIZONTAL = 'horizontal';

    /**
     * The form to convert.
     *
     * @var Zend_Form
     */
    protected static $_form;

    /**
     * Twitter form type
     *
     * @var string
     */
    protected static $_formType = self::FORM_TYPE_BASIC;

    /**
     * Set form
     *
     * @param Zend_Form $form
     * @return void
     */
    protected static function _setForm($form)
    {
        if (is_object($form) && $form instanceof Zend_Form) {
            self::$_form = $form;
        }
    }

    /**
     * Set form type
     *
     * @param string $formType
     * @return void
     */
    protected static function _setFormType($formType)
    {
        if (in_array($formType, array(
                self::FORM_TYPE_BASIC,
                self::FORM_TYPE_HORIZONTAL,
                self::FORM_TYPE_INLINE,
            ))) {
            self::$_formType = $formType;
        }
    }

    /**
     * Get form
     *
     * @return Zend_Form
     */
    protected static function _getForm()
    {
        return self::$_form;
    }

    /**
     * Get form type
     *
     * @return string
     */
    protected static function _getFormType()
    {
        return self::$_formType;
    }

   /**
    * Convert a form into a Bootstrap form.
    *
    * @param Zend_Form $form
    * @param string $formType "inline" or "horizontal". In Bootstrap, default
    * is vertical ("basic").
    */
    public static function redecorate(Zend_Form $form = null, string $formType = null)
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Decorator' . DIRECTORY_SEPARATOR . 'Checkboxlabel.php';
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Decorator' . DIRECTORY_SEPARATOR . 'Errors.php';

        if (!is_null($form)) {
            self::_setForm($form);
        }
        $form = self::_getForm();
        if (empty($form)) {
            throw new Exception(__('Invalid argument: a Zend_Form is required.'));
        }

        if (!is_null($formType)) {
            self::_setFormType($formType);
        }
        $formType = self::_getFormType();

        // Get rid of all the pre-defined decorators.
        $form->clearDecorators();

        // Decorators for all the form elements.
        $form->setElementDecorators(self::_getElementDecorators());

        // Decorators for the form itself.
        $form
            ->addDecorator('FormElements')
            ->addDecorator('Form');

        // Set the main class of the form according to the type.
        switch ($formType) {
            case self::FORM_TYPE_HORIZONTAL:
                $form->addAttribs(array('class' => 'form-horizontal'));
                break;
            case self::FORM_TYPE_INLINE:
                $form->addAttribs(array('class' => 'form-inline'));
                break;
            case self::FORM_TYPE_BASIC:
                // Nothing to set.
        }

        foreach ($form->getElements() as $element) {
            $classElement = get_class($element);
            switch ($classElement) {
                case 'Zend_Form_Element_File':
                    $decorators = self::_getElementDecorators();
                    $decorators[0] = 'File';
                    $element->setDecorators($decorators);
                    break;

                case 'Zend_Form_Element_Submit':
                case 'Zend_Form_Element_Reset':
                case 'Zend_Form_Element_Button':
                    $element->setAttrib('class', trim('btn ' . $element->getAttrib('class')));
                    $element->removeDecorator('Label');
                    $element->removeDecorator('outerwrapper');
                    $element->removeDecorator('innerwrapper');
                    if ($formType == self::FORM_TYPE_HORIZONTAL) {
                        $displayGroup = self::_addElementToActionsDisplayGroup($element);
                    }
                    break;

                case 'Zend_Form_Element_Checkbox':
                    $element->setDecorators(array(
                        array(array('labelopening' => 'HtmlTag'), array('tag' => 'label', 'id' => $element->getId() . '-label', 'for' => $element->getName(), 'openOnly' => true)),
                        'ViewHelper',
                        array(new Twitter_Form_Decorator_Checkboxlabel()),
                        array(array('labelclosing' => 'HtmlTag'), array('tag' => 'label', 'closeOnly' => true)),
                        array(new Twitter_Form_Decorator_Errors(), array('placement' => 'append')),
                        array('Description', array('tag' => 'span', 'class' => 'help-block')),
                        array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'checkbox'))
                    ));

                    if ($formType == self::FORM_TYPE_HORIZONTAL) {
                        $element->addDecorators(array(
                            array(array('checkboxinnerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-sm-offset-2 col-sm-10')),
                            array(array('innerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group'))
                        ));
                    }
                    break;

                case 'Zend_Form_Element_Radio':
                case 'Zend_Form_Element_MultiCheckbox':
                    $multiOptions = array();
                    foreach ($element->getMultiOptions() as $value => $label) {
                        $multiOptions[$value] = ' ' . $label;
                    }

                    $element->setMultiOptions($multiOptions);
                    $element->setAttrib('labelclass', 'checkbox');

                    // if ($formType == self::FORM_TYPE_INLINE) {
                    //     $element->setAttrib('labelclass', 'checkbox-inline');
                    // }

                    if ($element instanceof Zend_Form_Element_Radio) {
                        $element->setAttrib('labelclass', 'radio');
                    }

                    // if ($formType == self::FORM_TYPE_INLINE) {
                    //     $element->setAttrib('labelclass', 'radio-inline');
                    // }

                    $element->setOptions(array('separator' => ''));

                    if ($formType == self::FORM_TYPE_HORIZONTAL) {
                        $element->setDecorators(array(
                            'ViewHelper',
                            array(new Twitter_Form_Decorator_Errors(), array('placement' => 'append')),
                            array('Description', array('tag' => 'span', 'class' => 'help-block')),
                            array(array('innerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-sm-10')),
                            array('Label', array('class' => 'control-label col-sm-2')),
                            array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group form-group-multi'))
                        ));
                    } else {
                        $element->setDecorators(array(
                            'ViewHelper',
                            array(new Twitter_Form_Decorator_Errors(), array('placement' => 'append')),
                            array('Description', array('tag' => 'span', 'class' => 'help-block')),
                            array('label', array('tag' => 'div', 'class' => 'control-label')),
                            array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group form-group-multi'))
                        ));
                    }
                    break;

                case 'Zend_Form_Element_Hidden':
                // Special Omeka form elements.
                case 'Omeka_Form_Element_SessionCsrfToken':
                    $element->setDecorators(array('ViewHelper'));
                    break;

                case 'Zend_Form_Element_Textarea':
                    if (!$element->getAttrib('rows')) {
                        $element->setAttrib('rows', '3');
                    }
                    // No break.
                case 'Zend_Form_Element_Text':
                case 'Zend_Form_Element_Password':
                case 'Zend_Form_Element_Select':
                    $element->setAttrib('class', trim($element->getAttrib('class') . ' form-control'));
                    break;

                case 'Zend_Form_Element_Captcha':
                    $element->removeDecorator('viewhelper');
                    break;

                case 'Zend_Form_Element':
                default:
                    // Use default decorators.
            }
        }

        return $form;
    }

    /**
     * Default decorators
     *
     * @return array
     */
    protected static function _getElementDecorators()
    {
        $formType = self::_getFormType();
        switch ($formType) {
            case self::FORM_TYPE_HORIZONTAL:
                return array(
                    'ViewHelper',
                    array(new Twitter_Form_Decorator_Errors(), array('placement' => 'append')),
                    array('Description', array('tag' => 'span', 'class' => 'help-block')),
                    array(array('innerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-sm-10')),
                    array('Label', array('class' => 'control-label col-sm-2')),
                    array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group'))
                );

            case self::FORM_TYPE_INLINE:
            case self::FORM_TYPE_BASIC:
            default:
                return array(
                    'ViewHelper',
                    array(new Twitter_Form_Decorator_Errors(), array('placement' => 'append')),
                    array('Description', array('tag' => 'span', 'class' => 'help-block')),
                    array('Label', array('class' => 'control-label')),
                    array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group'))
                );
        }
    }

    /**
     * Add decorators for a group of elements (buttons).
     *
     * @param Zend_Form_Element $element
     * @return Zend_Form_DisplayGroup
     */
    protected static function _addElementToActionsDisplayGroup($element)
    {
        $form = self::_getForm();

        $displayGroup = $form->getDisplayGroup('actions');

        if (is_null($displayGroup)) {
            $form->addDisplayGroup(
                array($element),
                'actions',
                array(
                    'disableLoadDefaultDecorators' => true,
                )
            );
            $displayGroup = $form->getDisplayGroup('actions');
            $displayGroup->setDecorators(array(
                'FormElements',
                array(array('displaygroupinnerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-sm-offset-2 col-sm-10')),
                array(array('outerwrapper' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group'))
            ));
        } else {
            $displayGroup->addElement($element);
        }

        return $displayGroup;
    }
}
