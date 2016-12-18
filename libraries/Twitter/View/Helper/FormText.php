<?php
class Twitter_View_Helper_FormText extends Zend_View_Helper_FormText
{
    public function formText($name, $value = null, $attribs = null)
    {
        $class = 'form-control';
        if (is_array($name) && isset($name['attribs']['class'])) {
            $name['attribs']['class'] = trim($name['attribs']['class'] . ' ' . $class);
        } elseif (is_array($attribs)) {
            $attribs['class'] = trim(@$attribs['class'] . ' ' . $class);
        } else {
            $attribs = array('class' => $class);
        }
        return parent::formText($name, $value, $attribs);
    }
}
