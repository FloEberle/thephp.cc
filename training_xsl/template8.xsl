<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div>
            <xsl:choose>
                <xsl:when test="//category[@id]">test</xsl:when>
                <xsl:otherwise>default</xsl:otherwise>
            </xsl:choose>
        </div>
    </xsl:template>

</xsl:stylesheet>