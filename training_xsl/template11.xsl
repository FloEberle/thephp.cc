<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <xsl:variable name="class" select="//category" />
        <div>
            <xsl:value-of select="$class/@id" />
            <xsl:copy-of select="$class" />
            <xsl:copy-of select="//description" />
        </div>
    </xsl:template>

</xsl:stylesheet>