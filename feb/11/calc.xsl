<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:func="http://exslt.org/functions"
                extension-element-prefixes="func"
        >

<func:function name="calcAttrAverageFromNodeSet">
    <xsl:param name="nodeSet" />
    <xsl:param name="attr" />
    <func:result select="'hello world'" />
</func:function>

</xsl:stylesheet>