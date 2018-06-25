<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 * 
 * @property string sid
 * @property string uniqueName
 * @property string accountSid
 * @property string serviceSid
 * @property string url
 * @property array links
 * @property string revision
 * @property \DateTime dateExpires
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string createdBy
 */
class SyncMapInstance extends InstanceResource {
    protected $_syncMapItems = null;
    protected $_syncMapPermissions = null;

    /**
     * Initialize the SyncMapInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The service_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Sync\V1\Service\SyncMapInstance 
     */
    public function __construct(Version $version, array $payload, $serviceSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
            'revision' => Values::array_get($payload, 'revision'),
            'dateExpires' => Deserialize::dateTime(Values::array_get($payload, 'date_expires')),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'createdBy' => Values::array_get($payload, 'created_by'),
        );

        $this->solution = array('serviceSid' => $serviceSid, 'sid' => $sid ?: $this->properties['sid']);
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncMapContext Context for this
     *                                                     SyncMapInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new SyncMapContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a SyncMapInstance
     * 
     * @return SyncMapInstance Fetched SyncMapInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the SyncMapInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Update the SyncMapInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return SyncMapInstance Updated SyncMapInstance
     */
    public function update($options = array()) {
        return $this->proxy()->update($options);
    }

    /**
     * Access the syncMapItems
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncMap\SyncMapItemList 
     */
    protected function getSyncMapItems() {
        return $this->proxy()->syncMapItems;
    }

    /**
     * Access the syncMapPermissions
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncMap\SyncMapPermissionList 
     */
    protected function getSyncMapPermissions() {
        return $this->proxy()->syncMapPermissions;
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Sync.V1.SyncMapInstance ' . implode(' ', $context) . ']';
    }
}