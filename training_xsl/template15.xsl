<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:param name="config" select="'wertvoll'"/>

    <xsl:template match="/">
        <xsl:value-of select="$config" />
    </xsl:template>

</xsl:stylesheet>