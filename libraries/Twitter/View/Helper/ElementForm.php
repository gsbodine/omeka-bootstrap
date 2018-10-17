<?php
/**
 * Omeka
 *
 * @copyright Copyright 2007-2012 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Generate the Twitter form markup for entering element text metadata.
 *
 * @package Omeka\View\Helper
 */
class Twitter_View_Helper_ElementForm extends Omeka_View_Helper_ElementForm
{
    /**
     * Displays a form for the record's element.
     *
     * The function applies filters that allow plugins to customize the display of element form components.
     * Here is an example of how a plugin may add and implement an element form filter:
     *
     * add_filter(array('ElementForm', 'Item', 'Dublin Core', 'Title')), 'form_item_title');
     * function form_item_title(array $components, $args)
     * {
     *
     *   // Where $components would looks like:
     *   //  array(
     *   //      'label' => [...],
     *   //      'inputs' => [...],
     *   //      'description' => [...],
     *   //      'comment' => [...],
     *   //      'add_input' => [...],
     *   //  )
     *   // and $args looks like:
     *   //  array(
     *   //      'record' => [...],
     *   //      'element' => [...],
     *   //      'options' => [...],
     *   //  )
     * }
     *
     * @var Element
     */
    protected $_element;
    protected $_record;

    public function elementForm(Element $element, Omeka_Record_AbstractRecord $record, $options = array())
    {
        $divWrap = isset($options['divWrap']) ? $options['divWrap'] : true;
        $extraFieldCount = isset($options['extraFieldCount']) ? $options['extraFieldCount'] : null;

        $this->_element = $element;

        // This will load all the Elements available for the record and fatal error
        // if $record does not use the ActsAsElementText mixin.
        $record->loadElementsAndTexts();
        $this->_record = $record;

        // Filter the components of the element form display
        $labelComponent = $this->_getLabelComponent();
        $inputsComponent = $this->_getInputsComponent($extraFieldCount);
        $descriptionComponent = $this->_getDescriptionComponent();
        $commentComponent = $this->_getCommentComponent();
        $addInputComponent = $this->view->formButton('add_element_' . $this->_element['id'],
            __('Add Input'), array('class'=>'add-element'));
        $components = array(
            'label' => $labelComponent,
            'inputs' => $inputsComponent,
            'description' => $descriptionComponent,
            'comment' => $commentComponent,
            'add_input' => $addInputComponent,
            'html' => null
        );

        $elementSetName = $element->set_name;
        $recordType = get_class($record);
        $filterName = array('ElementForm', $recordType, $elementSetName, $element->name);
        $components = apply_filters(
            $filterName,
            $components,
            array('record' => $record,
                  'element' => $element,
                  'options' => $options)
        );

        if ($components['html'] !== null) {
            return strval($components['html']);
        }

        return $this->_bootstrapElementForm($components, $element, $divWrap);
    }

    /**
     * Compose html for element form
     *
     * @param array $components
     * @param Element $element
     * @param boolean $divWrap
     * @return string
     */
    protected function _bootstrapElementForm($components, $element, $divWrap)
    {
        $html = $divWrap ? '<div class="form-group" id="element-' . html_escape($element->id) . '">' : '';

        $html .= $components['label'];
        $html .= $components['add_input'];

        $html .= '<div class="col-sm-10">';
        $html .= $components['inputs'];
        $html .= $components['description'];
        $html .= $components['comment'];
        $html .= '</div>'; // Close 'inputs' div

        $html .= $divWrap ? '</div>' : ''; // Close 'field' div

        return $html;
    }

    protected function _getInputsComponent($extraFieldCount = null)
    {
        $fieldCount = $this->_getFormFieldCount() + (int) $extraFieldCount;
        $html = '';
        for ($i=0; $i < $fieldCount; $i++) {
            $html .= $this->view->elementInput(
                $this->_element, $this->_record, $i,
                $this->_getValueForField($i), $this->_getHtmlFlagForField($i));
        }
        return $html;
    }

    protected function _getDescriptionComponent()
    {
        $description = $this->_getFieldDescription();
        if ($description) {
            return '<p class="help-block">' . __($description) . '</p>';
        }
        return '';
    }

    protected function _getCommentComponent()
    {
        $comment = $this->_getFieldComment();
        if ($comment) {
            return '<p class="help-block">' . $comment . '</p>';
        }
        return '';
    }

    protected function _getLabelComponent()
    {
        return '<label class="control-label col-sm-2">' . __($this->_getFieldLabel()) . '</label>';
    }
}
