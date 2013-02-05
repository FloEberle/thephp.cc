<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div>
            <xsl:if test="//category/@id = '13'">
                <xsl:text>....</xsl:text>
            </xsl:if>
        </div>
    </xsl:template>

</xsl:stylesheet>