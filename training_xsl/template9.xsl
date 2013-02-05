<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div>
            <div>
                <xsl:call-template name="class" />
            </div>
            <div>
                <xsl:call-template name="class" />
            </div>
        </div>
    </xsl:template>

    <xsl:template name="class">
        <xsl:attribute name="class">
            <xsl:choose>
                <xsl:when test="//category[@id]">test</xsl:when>
                <xsl:otherwise>default</xsl:otherwise>
            </xsl:choose>
        </xsl:attribute>
    </xsl:template>

</xsl:stylesheet>