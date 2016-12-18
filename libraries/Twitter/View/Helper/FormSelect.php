<?php
class Twitter_View_Helper_FormSelect extends Zend_View_Helper_FormSelect
{
    public function formSelect($name, $value = null, $attribs = null,
        $options = null, $listsep = "<br />\n")
    {
        $class = 'form-control';
        if (is_array($name) && isset($name['attribs']['class'])) {
            $name['attribs']['class'] = trim($name['attribs']['class'] . ' ' . $class);
        } elseif (is_array($attribs)) {
            $attribs['class'] = trim(@$attribs['class'] . ' ' . $class);
        } else {
            $attribs = array('class' => $class);
        }
        return parent::formSelect($name, $value, $attribs, $options, $listsep);
    }
}
