<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:variable name="foo" select="'xxx'" />

    <xsl:template name="body">
        <xsl:param name="local" select="$foo" />
        <div>Hier ist der body <xsl:value-of select="$local" /></div>
    </xsl:template>

</xsl:stylesheet>