<?php
class Twitter_View_Helper_FormLabel extends Zend_View_Helper_FormLabel
{
    public function formLabel($name, $value = null, array $attribs = null)
    {
        $class = 'control-label col-sm-2';
        if (is_array($name) && isset($name['attribs']['class'])) {
            $name['attribs']['class'] = trim($name['attribs']['class'] . ' ' . $class);
        } elseif (is_array($attribs)) {
            $attribs['class'] = trim(@$attribs['class'] . ' ' . $class);
        } else {
            $attribs = array('class' => $class);
        }
        return parent::formLabel($name, $value, $attribs);
    }
}
