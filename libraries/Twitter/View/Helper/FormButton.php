<?php
class Twitter_View_Helper_FormButton extends Zend_View_Helper_FormButton
{
    public function formButton($name, $value = null, $attribs = null)
    {
        $class = 'btn btn-default';
        if (is_array($name) && isset($name['attribs']['class'])) {
            $name['attribs']['class'] = trim($name['attribs']['class'] . ' ' . $class);
        } elseif (is_array($attribs)) {
            $attribs['class'] = trim(@$attribs['class'] . ' ' . $class);
        } else {
            $attribs = array('class' => $class);
        }
        return parent::formButton($name, $value, $attribs);
    }
}
