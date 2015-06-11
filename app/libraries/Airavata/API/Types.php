<?php
namespace Airavata\API;

/**
 * Autogenerated by Thrift Compiler (0.9.2)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 * @generated
 */


final class Constant extends \Thrift\Type\TConstant
{
    static protected $AIRAVATA_API_VERSION;

    static protected function init_AIRAVATA_API_VERSION()
    {
        return /**
         * Airavata Interface Versions depend upon this Thrift Interface File. When Making changes, please edit the
         *  Version Constants according to Semantic Versioning Specification (SemVer) http://semver.org.
         *
         * Note: The Airavata API version may be different from the Airavata software release versions.
         *
         * The Airavata API version is composed as a dot delimited string with major, minor, and patch level components.
         *
         *  - Major: Incremented for backward incompatible changes. An example would be changes to interfaces.
         *  - Minor: Incremented for backward compatible changes. An example would be the addition of a new optional methods.
         *  - Patch: Incremented for bug fixes. The patch level should be increased for every edit that doesn't result
         *              in a change to major/minor version numbers.
         *
         */
            "0.15.0";
    }
}


