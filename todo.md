**Helpers**

- validate_xml($xml, $xsd = null) :: returns array of errors, or false

- is_valid_xml($xml, $xsd = null) :: returns bool

**Facade**

* similar to the helpers

- Xml::validate($xml, $xsd = null)

- Xml::is_valid($xml, $xsd = null)

**Configuration**

- Move configurations to a config file

**Middleware**

- Register xml middleware by default from package. **Issue**: [18787](https://github.com/laravel/framework/issues/18787)

**Assertions**

- assertExactJson > assertExactXml
- assertJson > assertXml
- assertJsonCount > assertXmlCount
- assertJsonFragment > assertXmlFragment
- assertJsonMissing > assertXmlMissing
- assertJsonMissingExact > assertXmlMissingExact
- assertJsonStructure > assertXmlStructure
- assertJsonValidationErrors > assertXmlValidationErrors

**Tests**

- Implement tests

**Continous Integration**

- Use Travis-CI