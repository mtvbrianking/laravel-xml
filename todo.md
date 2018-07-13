**Working with collections**
- Determine if collection, and change it to an array before encoding to xml

**Validate request, response macros**

- Using Ajax, Axios request

- Multiple values in `accept` header

- Different valid xml formats; say: `'text/xml'`, `'application/xml'`, `'application/x-xml'`

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

**Continuous Integration**

- Use Travis-CI