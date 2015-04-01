<?php
use Staple\Form\CheckboxElement;
use Staple\Form\Form;
use Staple\Form\PasswordElement;
use Staple\Form\SubmitElement;
use Staple\Form\TextareaElement;
use Staple\Form\TextElement;
use Staple\Form\Validate\InArrayValidator;
use Staple\Form\Validate\LengthValidator;
use Staple\Form\Validate\NumericValidator;

/**
 * Created by PhpStorm.
 * User: adam
 * Date: 3/28/15
 * Time: 2:16 PM
 * 
 * @copyright Copyright (c) 2011, STAPLE CODE
 * 
 * This file is part of the STAPLE Framework.
 * 
 * The STAPLE Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by the 
 * Free Software Foundation, either version 3 of the License, or (at your option)
 * any later version.
 * 
 * The STAPLE Framework is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for 
 * more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with the STAPLE Framework.  If not, see <http://www.gnu.org/licenses/>.
 */

class testForm extends Form
{
    public function _start()
    {
        $this->setName('test');

        $name = new TextElement('name','Name');
        $name->setRequired()
            ->addValidator(new LengthValidator(1,30))
            ->setInstructions('Here is a test.');

        $textarea = new TextareaElement('textarea','Textarea');
        $textarea->setRequired()
            ->addValidator(new LengthValidator(1,30))
            ->setInstructions('Here is a test');

        $password = new PasswordElement('password','Password');
        $password->setRequired()
            ->addValidator(new LengthValidator(1,30))
            ->addValidator(new NumericValidator())
            ->setInstructions('Here are the instructions for this field');

        $checkbox = new CheckboxElement('checkbox','Checkbox');
        $checkbox->setRequired()
            ->setInstructions('Here are some instructions.')
            ->addValidator(
                new InArrayValidator(
                    array("checkbox")
                )
            );

        $submit = new SubmitElement('submit','Submit');

        $this->addField($name, $textarea, $password, $checkbox, $submit);
    }
}