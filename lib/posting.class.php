<?php

/**
 * Convert data into a node type Posting, machine name: community
 */

Class Posting {

  /**
   * @var string $messageBody Contents of text message to send.
   */
  public $messageBody;

  /**
   * Equivalent to drupal field 'field_posting_event_date'.
   * why is this required?
   * 
   * @var date $eventDate Date of event?
   */
  public $eventDate;

  /**
   * Equivalent to drupal field 'field_event_status'.
   * why is this required?
   * 
   * @var boolean $status Options are enabled or expired.
   */
  public $status;

  /**
   * Equivalent to drupal field 'field_posting_message_date'.
   * this is not required?
   * 
   * @var date $messageDate Date the message should be sent.
   */
  public $messageDate;

  /**
   * Equivalent to drupal field 'field_community_category'.
   * Relevant to taxonomy Categories, machine name: community_categories.
   * this is required, but we dont actually want to use it ...?
   * 
   * @var number $targetAudience Term ID of the target audience.
   */
  public $targetAudience;

  /**
   * Equivalent to Drupal field 'field_organization'.
   * Relevant to nodes of type Service Provider, machine name: effort_instance.
   * 
   * @var number $provider Node ID of the group that is sending the message.
   */
  public $provider;

  /**
   * Equivalent to Drupal field 'field_recipients'.
   * 
   * @var string $recipient User IDs, i.e. phone numbers, of specific users to receive the message.
   */
  public $recipient;

  /**
   * @param stdClass $data Data object with properties.
   */
  public function __construct(stdClass $data, $provider = NULL) {
    $this->recipient = $data->phone;
    $this->eventDate = $this->setDate($data->date);
    $this->provider  = isset($provider) ? $provider : 'Hope One Source';
  }

  /**
   * @param string $date Date string to convert into date object.
   */
  public function setDate(string $date) {
    $dd = new DateTime();
    $format = 'Y-m-d H:i';
    $eventDate = $dd->createFromFormat($format, $date);
    return $eventDate;
  }

  /**
   * Add message body.
   * 
   * @param string $msg Body text for message.
   */
  public function addBody(string $msg) {
    // Perform replacements.
    $msg = str_replace("\$provider", $this->provider, $msg);
    $msg = str_replace("\$date", $this->eventDate->format("m/d H:i A"), $msg);
    
    $this->messageBody = $msg;
  }

  /**
   * Debugging function.
   */
  public function speak() {
    $item = '';

    if (isset($this->messageBody)) {
      $messageBody = $this->messageBody;
      $item .= "Body: ${messageBody}, ";
    }
    if (isset($this->recipient)) {
      $recipient = $this->recipient;
      $item .= "Recipients: ${recipient}, ";
    }
    if (isset($this->eventDate)) {
      $eventDate = $this->eventDate->format("m/d H:i A");
      $item .= "Date: ${eventDate}, ";
    }

    return $item;
  }
}