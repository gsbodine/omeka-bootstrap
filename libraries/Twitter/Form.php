<?php

/**
 * Class Twitter_Form
 */
class Twitter_Form extends Zend_Form
{
    /**
     * Twitter form types definitions
     */
    const FORM_TYPE_BASIC = 'basic';
    const FORM_TYPE_INLINE = 'inline';
    const FORM_TYPE_HORIZONTAL = 'horizontal';

    /**
     * Twitter form type
     *
     * @var string
     */
    protected $type = self::FORM_TYPE_BASIC;

    /**
     * Instance of construct
     *
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        // Get rid of all the pre-defined decorators
        $this->clearDecorators();

        // Decorators for all the form elements
        $this->setElementDecorators($this->getElementDecorators());

        // Decorators for the form itself
        $this->addDecorator("FormElements")
             ->addDecorator('Form');

        parent::__construct($options);
    }

    /**
     * @see Zend_Form::addElement
     *
     * We have to override this, because we have to set some special decorators
     * on a per-element basis (checkboxes and submit buttons have different
     * decorators than other elements)
     */
    public function addElement($element, $name = null, $options = null)
    {
        parent::addElement($element, $name, $options);

        if (!$element instanceof Zend_Form_Element && $name != null) {
            $element = $this->getElement($name);
        }

        if ($element instanceof Zend_Form_Element_File) {
            $decorators = $this->getElementDecorators();
            $decorators[0] = "File";
            $element->setDecorators($decorators);
        }

        // Special style for Zend
        if ($element instanceof Zend_Form_Element_Submit || $element instanceof Zend_Form_Element_Reset || $element instanceof Zend_Form_Element_Button) {

            $element->setAttrib("class", trim('btn ' . $element->getAttrib("class")));
            $element->removeDecorator("Label");
            $element->removeDecorator("outerwrapper");
            $element->removeDecorator("innerwrapper");

            if ($this->getType() === self::FORM_TYPE_HORIZONTAL) {
                $this->addActionsDisplayGroupElement($element);
            }
        }

        if ($element instanceof Zend_Form_Element_Checkbox) {
            $element->setDecorators(array(
                array(array("labelopening" => "HtmlTag"), array("tag" => "label", "id" => $element->getId() . "-label", "for" => $element->getName(), "openOnly" => true)),
                "ViewHelper",
                array(new \Twitter_Form_Decorator_Checkboxlabel()),
                array(array("labelclosing" => "HtmlTag"), array("tag" => "label", "closeOnly" => true)),
                array(new Twitter_Form_Decorator_Errors(), array("placement" => "append")),
                array("Description", array("tag" => "span", "class" => "help-block")),
                array(array("outerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "checkbox"))
            ));

            if ($this->getType() === self::FORM_TYPE_HORIZONTAL) {
                $element->addDecorators(array(
                    array(array("checkboxinnerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "col-sm-offset-2 col-sm-10")),
                    array(array("innerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "form-group"))
                ));
            }
        }

        if ($element instanceof Zend_Form_Element_Radio || $element instanceof Zend_Form_Element_MultiCheckbox) {
            $multiOptions = array();
            foreach ($element->getMultiOptions() as $value => $label) {
                $multiOptions[$value] = " " . $label;
            }

            $element->setMultiOptions($multiOptions);
            $element->setAttrib("labelclass", "checkbox");

//            if ($this->getType() === self::FORM_TYPE_INLINE) {
//                $element->setAttrib("labelclass", "checkbox-inline");
//            }

            if ($element instanceof Zend_Form_Element_Radio) {
                $element->setAttrib("labelclass", "radio");
            }

//            if ($this->getType() === self::FORM_TYPE_INLINE) {
//                $element->setAttrib("labelclass", "radio-inline");
//            }

            $element->setOptions(array("separator" => ""));

            if ($this->getType() === self::FORM_TYPE_HORIZONTAL) {
                $element->setDecorators(array(
                    "ViewHelper",
                    array(new Twitter_Form_Decorator_Errors(), array("placement" => "append")),
                    array("Description", array("tag" => "span", "class" => "help-block")),
                    array(array("innerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "col-sm-10")),
                    array("Label", array("class" => "control-label col-sm-2")),
                    array(array("outerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "form-group form-group-multi"))
                ));
            } else {
                $element->setDecorators(array(
                    "ViewHelper",
                    array(new Twitter_Form_Decorator_Errors(), array("placement" => "append")),
                    array("Description", array("tag" => "span", "class" => "help-block")),
                    array("label", array("tag" => "div", "class" => "control-label")),
                    array(array("outerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "form-group form-group-multi"))
                ));
            }
        }

        if ($element instanceof Zend_Form_Element_Hidden) {
            $element->setDecorators(array("ViewHelper"));
        }

        if ($element instanceof Zend_Form_Element_Textarea && !$element->getAttrib('rows')) {
            $element->setAttrib('rows', '3');
        }

        if ($element instanceof Zend_Form_Element_Text
            || $element instanceof Zend_Form_Element_Textarea
            || $element instanceof Zend_Form_Element_Password
            || $element instanceof Zend_Form_Element_Select
        ) {
            $element->setAttrib('class', trim($element->getAttrib('class') . ' form-control'));
        }

        if ($element instanceof Zend_Form_Element_Captcha) {
            $element->removeDecorator("viewhelper");
        }

        return $this;
    }

    /**
     * Render
     *
     * @param  Zend_View_Interface $view
     * @return Zend_View
     */
    public function render(Zend_View_Interface $view = null)
    {
        $this->setAttrib('class', trim(sprintf('form-%s %s', $this->getType(), $this->getAttrib('class'))));

        return parent::render($view);
    }

    /**
     * Default decorators
     *
     * @return array
     */
    protected function getElementDecorators()
    {
        $formType = $this->getType();
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
     * Actions decorators for buttons
     *
     * @param $element
     * @return null|Zend_Form|Zend_Form_DisplayGroup
     */
    protected function addActionsDisplayGroupElement($element)
    {
        $displayGroup = $this->getDisplayGroup("actions");

        if ($displayGroup === null) {
            $this->addDisplayGroup(
                array($element),
                "actions",
                array(
                    'disableLoadDefaultDecorators' => true,
                )
            );
            $displayGroup = $this->getDisplayGroup('actions');
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

    /**
     * Set form type
     *
     * @param string Twitter_Form
     * @return Twitter_Form
     */
    public function setType($type)
    {
        if (in_array($type, array(self::FORM_TYPE_BASIC, self::FORM_TYPE_HORIZONTAL, self::FORM_TYPE_INLINE))) {
            $this->type = $type;
        }

        return $this;
    }

    /**
     * Get form type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}