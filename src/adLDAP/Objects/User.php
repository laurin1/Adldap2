<?php

namespace adLDAP\Objects;

use adLDAP\Exceptions\adLDAPException;

/**
 * Class User
 * @package adLDAP\Objects
 */
class User extends AbstractObject
{
    /**
     * The required attributes for the toSchema method
     *
     * @var array
     */
    protected $required = array(
        'username',
        'firstname',
        'surname',
        'email',
        'container',
    );

    /**
     * Checks the attributes for errors and returns the attributes array.
     *
     * @return array
     * @throws adLDAPException
     */
    public function toSchema()
    {
        $this->validateRequired();

        // Make sure the container attribute is an array
        if ( ! is_array($this->getAttribute('container'))) throw new adLDAPException('Container attribute must be an array');

        // Set the display name if it's not set
        if ($this->getAttribute('display_name') === null)
        {
            $displayName = $this->getAttribute('firstname') . " " . $this->getAttribute('surname');

            $this->setAttribute('display_name', $displayName);
        }

        return $this->attributes;
    }
}