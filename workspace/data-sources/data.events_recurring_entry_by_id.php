<?php

	require_once(TOOLKIT . '/class.datasource.php');

	Class datasourceevents_recurring_entry_by_id extends SectionDatasource {

		public $dsParamROOTELEMENT = 'events-recurring-entry-by-id';
		public $dsParamConditionalizer = '(if value of ({$pt1}) is (events))';
		public $dsParamORDER = 'desc';
		public $dsParamPAGINATERESULTS = 'yes';
		public $dsParamLIMIT = '1';
		public $dsParamSTARTPAGE = '1';
		public $dsParamREDIRECTONEMPTY = 'no';
		public $dsParamREQUIREDPARAM = '$pt2';
		public $dsParamPARAMOUTPUT = array(
				'verses'
		);
		public $dsParamSORT = 'system:id';
		public $dsParamHTMLENCODE = 'yes';
		public $dsParamASSOCIATEDENTRYCOUNTS = 'yes';
		public $dsParamCACHE = '0';
		

		public $dsParamFILTERS = array(
				'id' => '{$pt2}',
				'214' => 'no',
		);
		

		public $dsParamINCLUDEDELEMENTS = array(
				'name: unformatted',
				'frequency: unformatted',
				'description: unformatted',
				'locations: name-formal: unformatted',
				'locations: name-casual: unformatted',
				'locations: address',
				'locations: city',
				'locations: state',
				'locations: zip',
				'locations: latitude',
				'locations: longitude',
				'downloads: file',
				'downloads: link',
				'images: image',
				'images: height',
				'images: color',
				'images: background',
				'verses: passage',
				'member-role: member: first-name',
				'member-role: member: last-name',
				'member-role: member: photo',
				'member-role: member: email',
				'member-role: member: phone-number',
				'member-role: member: anonymize',
				'childcare'
		);
		

		public function __construct($env=NULL, $process_params=true) {
			parent::__construct($env, $process_params);
			$this->_dependencies = array();
		}

		public function about() {
			return array(
				'name' => 'Events: Recurring: Entry by ID',
				'author' => array(
					'name' => 'Brian Zerangue',
					'website' => 'http://churchdeploy.site',
					'email' => 'brian.zerangue@gmail.com'),
				'version' => 'Symphony 2.3.2',
				'release-date' => '2013-07-28T06:00:52+00:00'
			);
		}

		public function getSource() {
			return '21';
		}

		public function allowEditorToParse() {
			return true;
		}

		public function execute(array &$param_pool = null) {
			$result = new XMLElement($this->dsParamROOTELEMENT);

			try{
				$result = parent::execute($param_pool);
			}
			catch(FrontendPageNotFoundException $e){
				// Work around. This ensures the 404 page is displayed and
				// is not picked up by the default catch() statement below
				FrontendPageNotFoundExceptionHandler::render($e);
			}
			catch(Exception $e){
				$result->appendChild(new XMLElement('error', $e->getMessage()));
				return $result;
			}

			if($this->_force_empty_result) $result = $this->emptyXMLSet();

			return $result;
		}

	}
