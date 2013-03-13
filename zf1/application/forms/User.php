<?php
class Application_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setName('user');
        
        $iduser = new Zend_Form_Element_Hidden('iduser');
        
        $iduser->addFilter('Int');
        
        $name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
        		->setOptions(array('class'=>'nameAg'))
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_text.phtml'
				))))
				;
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->addValidator('EmailAddress');
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Description')
					->addValidator('NotEmpty');
		
		$address = new Zend_Form_Element_Text('address');
		$address->setLabel('Address')
    		->setRequired(true)
    		->addFilter('StripTags')
    		->addFilter('StringTrim')
    		->addValidator('NotEmpty');
		
		$gender = new Zend_Form_Element_Radio('genders_idgender');
		$gender->setLabel('Gender')
		->setRequired(true)
		->setMultiOptions(array(1=>'H', 2=>'M', 2=>'O'))
		->addValidator('NotEmpty');
		
		$photo = new Zend_Form_Element_File('photo');
		$photo->setLabel('Photo')
				->setDestination(APPLICATION_PATH.'/../public/uploads')
				->addValidator('Size', false, 1024000) // limit to 100K
				->setMaxFileSize(1024000); // limits the filesize on the client
		
		
		$city = new Zend_Form_Element_Select('cities_idcity');
		$city->setLabel('City')
				->setRequired(true)
				->setMultiOptions(array(1=>'SCQ', 2=>'BCN', 3=>'VGO'))
				->addValidator('NotEmpty');
		
		$sports = new Zend_Form_Element_MultiCheckbox('sports');
		$sports->setLabel('Sports')
				->setRequired(true)
				->setMultiOptions(array(1=>'Besibol', 2=>'Futbol', 3=>'Natacion'))
				->addValidator('NotEmpty');
				
		$pets = new Zend_Form_Element_Multiselect('pets');
		$pets->setLabel('Pets')
				->setRequired(true)
				->setMultiOptions(array(1=>'Perro', 2=>'Tigre', 3=>'Gato'))
				->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($iduser, $name, $email, $password,
		        				$description, $address, $gender, 
		                        $photo, $city, $sports, $pets,
		        				$submit));
    }
}