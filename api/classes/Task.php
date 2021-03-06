<?php

/*
 * To change this license header, choose License Headers in task Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task
 *
 * @author Irin.a
 */
class Task {

/*
Title,
Associated Course,
Client Org,
Training Authority,
Type,
Description,
Requested Completion Date
*/
	private $required = array('title', 'org', 'description');

	public $errors = array();
	private $collection = array();
	private $options = array();
    protected $jsonFields = array('opis', 'usa');

	public $title;
	public $course;
	public $org;
	public $ta;
	public $task_type;
	public $description;
	public $requested_completion_date;
	public $req_num;


	public $id;
	public $owner_guid;
	public $container_guid;
	public $access_id;
	public $time_created;
	private $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public static function withID($id, $session)
	{
		$instance = new self($session);
		$instance->loadByID($id);
		return $instance;
	}

	public static function withParams($params)
	{
		$instance = new self();
		if($params) {
			foreach($params as $key => $param) {
				if($key!="user_id" || $key != 'public_key') {
					$instance->$key = $param;
				}
			}
			if($params['user_id']) {
				$instance->subtype = "task_registry";
				$instance->owner_guid = $params['user_id'];
				$instance->container_guid = $params['user_id'];
				$instance->access_id = ACCESS_PUBLIC;
			}
		}
		return $instance;
	}

	public static function all($params, $session)
	{
		$instance = new self($session);
		$instance->loadAll($params);

		return $instance;
	}

	protected function loadByID($id)
	{
		$row = get_entity($id);

		$this->fill($row);
		$this->setAttachments();
	}

	protected function loadAll($params)
	{
		$this->options = array(
			"type" => "object",
			"subtype" => "task_registry",
			"limit" => false,
			"full_view" => false,
			"order_by" => "time_created DESC",
			"metadata_name_value_pairs" => array()
		);

		foreach($params as $key => $param) {
			if($key == 'owner_guid') {
				$this->options[$key] = $param;
			}
			else if($key != 'public_key') {
				$this->options["metadata_name_value_pairs"][] = array(
					"name" => $key,
					"value" => $param
				);
			}
		}

		$rows = elgg_get_entities_from_metadata($this->options);
		$this->fillWithRows($rows);
	}

	private function fill($row)
	{
		$this->id = $row->guid;
		$this->title = $row->title;
		$this->description = $row->description;
		$this->course = $row->course;
		$this->org = $row->org;
		$this->owner = get_entity($row->owner_guid)->name;
		$this->container_guid = $row->container_guid;
		$this->task_type = $row->task_type;
		$this->access_id = $row->access_id;
		$this->ta = $row->ta;

		if( $this->session->getTaskAdmin() || ($this->session->getPublicKey() == $row->owner_guid && $row->status=='Submitted') ) {
			$this->can_edit = true;
		}
	}

	private function fillWithRows($rows)
	{
		foreach($rows as $row) {
			$task = new Task($this->session);
			$task->fill($row);

			$this->addToCollection($task);
		}
	}

	public function validate()
	{
		//check required fields
		foreach($this as $key => $val) {
			if(in_array($key, $this->required)) {
				if(empty($val)) {
					$this->errors[$key] = $key." is a required field";
				}
			}
		}
		if(empty($this->errors)) {
			return true;
		}
		return false;
	}

	public function create()
	{
		elgg_set_ignore_access();

		$task = new ElggObject();
		foreach($this as $key => $val) {
			if(in_array($key, $this->jsonFields)) {
				$task->$key = json_encode($val);
			}
			else if($key=='options' || $key=='required'){
				//
			}
			else{
				$task->$key = $val;
			}
		}

		if($task->save()) {
			$this->id = $task->guid;
			return true;
		}
		else{
			return false;
		}
	}

	public function edit($payload)
	{
		elgg_set_ignore_access();

		$task = get_entity($this->id);
		foreach($payload as $key => $val) {
			if($key == 'opis' || $key == 'sme' || $key == 'usa') {
				$task->$key = json_encode($val);
			}
			else if($key=='options' || $key=='required' || $key=='id'){
				//
			}
			else{
				$task->$key = $val;
			}
		}

		if($task->save()) {
			return true;
		}
		else{
			return false;
		}
	}

	public function update($payload)
	{
		elgg_set_ignore_access();
		if(!array_key_exists('value', $payload)) {
            $this->errors[] = 'value not provided in request payload';
            return false;
        }

		$task = get_entity($this->id);
		if( in_array($payload['field'], $this->jsonFields) ) {
			$payload['value'] = json_encode($payload['value']);
		}

		$task->$payload['field'] = $payload['value'];
		if($task->save()) {
			$this->id = $task->guid;
			return true;
		}
		else{
			return false;
		}
	}

	public static function delete($task)
	{
		elgg_set_ignore_access();

		$task_entity = get_entity($task->id);

		if ($task_entity->delete()) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function saveAttachments($attachments, $id, $accessId)
	{
		elgg_set_ignore_access();
		$result = true;
		$count = count($attachments['name']);
		for ($i = 0; $i < $count; $i++) {
			if ($attachments['error'][$i] || !$attachments['name'][$i]) {
				continue;
			}

			$name = $attachments['name'][$i];

			$file = new ElggFile();
			$file->container_guid = $id;
			$file->title = $name;
			$file->access_id = (int) $accessId;

			$prefix = "file/";
			$filestorename = elgg_strtolower(time() . $name);
			$file->setFilename($prefix . $filestorename);


			$file->open("write");
			$file->close();
			move_uploaded_file($attachments['tmp_name'][$i], $file->getFilenameOnFilestore());

			$saved = $file->save();

			if ($saved) {
				$mime_type = ElggFile::detectMimeType($attachments['tmp_name'][$i], $attachments['type'][$i]);
				$info = pathinfo($name);
				$office_formats = array('docx', 'xlsx', 'pptx');
				if ($mime_type == "application/zip" && in_array($info['extension'], $office_formats)) {
					switch ($info['extension']) {
						case 'docx':
							$mime_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
							break;
						case 'xlsx':
							$mime_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
							break;
						case 'pptx':
							$mime_type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
							break;
					}
				}

				// check for bad ppt detection
				if ($mime_type == "application/vnd.ms-office" && $info['extension'] == "ppt") {
					$mime_type = "application/vnd.ms-powerpoint";
				}

				$file->setMimeType($mime_type);
				$file->originalfilename = $name;
				if (elgg_is_active_plugin('file')) {
					$file->simpletype = file_get_simple_type($mime_type);
				}
				$saved = $file->save();
				if($saved){
					$file->addRelationship($id, 'attachment');
					$result = true;
				}
			}
			else{
				$result = false;
			}
		}
		return $result;
	}

	private function setAttachments()
	{
		$attachments = elgg_get_entities_from_relationship(array(
			"relationship" => "attachment",
			"relationship_guid" => $this->id,
			"inverse_relationship" => true
		));

		foreach($attachments as $obj) {
			$attachment = new Attachment($obj);
			$this->attachments[] = $attachment;
		}
	}

	private function getAttachments()
	{
		return $this->attachments;
	}

	private function addToCollection($task)
	{
		$this->collection[] = $task;
	}

	public function getCollection()
	{
		return $this->collection;
	}

	public function sendEmail($action)
	{
		$usa_email = sanitise_string($this->usa['email']);
		$usa_name = $this->usa['name'];
		$task = get_entity($this->id);
		$owner = get_entity($this->container_guid);
		$site = elgg_get_site_entity();
		$site_url = elgg_get_site_entity()->url;

		switch($action){
			case 'submit':
				if(!$task)
				{
					register_error(elgg_echo('email:task:submit:taskNotFound'));
					return false;
				}

				//construct the email
				$from = "no-reply@lp-pa.forces.gc.ca";
				$to = $usa_email;
				$subject = elgg_echo('email:task:submit:heading');
				$link = "{$site_url}tasks#/tasks/view/{$this->id}";
				$message = elgg_echo('email:task:submit:body', array($usa_name, $owner->name, $this->title, $link, $site->name, $site_url));

				if(elgg_send_email($from, $to, $subject, $message))
				{
					return true;
				}
				else {
					register_error(elgg_echo('email:task:submit:error'));
					return false;
				}
				break;
		}
	}
}
