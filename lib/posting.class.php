<?php

Class Posting {

  /**
   * @var string $message Contents of text message to send.
   */
  public $message;

  /**
   * @var date $field_posting_event_date Date of event?
   * 
   * why is this required?
   */
  public $field_posting_event_date;

  /**
   * @var boolean $field_event_status Options are enabled or expired.
   * 
   * why is this required?
   */
  public $field_event_status;

  /**
   * @var date $field_posting_message_date Date the message should be sent.
   * 
   * this is not required?
   */
  public $field_posting_message_date;

  /**
   * @var number $field_community_category Term ID of the target audience.
   * 
   * this is required, but we dont actually want to use it ...?
   * 
   * relevant to taxonomy Categories, machine name: community_categories.
   */
  public $field_community_category;

  /**
   * @var number $field_organization Node ID of the group that is sending the message.
   * 
   * relevant to nodes of type Service Provider, machine name: effort_instance.
   */
  public $field_organization;

  /**
   * @var string $field_recipients User IDs, i.e. phone numbers, of specific users to receive the message.
   */
  public $field_recipients;

  /**
   * @param stdClass $data Data object with properties.
   */
  public function __construct(stdClass $data) {
    $this->field_recipients = $data->phone;
  }

  public function speak() {
    return $this;
  }
}