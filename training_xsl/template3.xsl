<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div></div>
    </xsl:template>

    <xsl:template match="/product">
        <p>hallo <xsl:value-of select="@name" /></p>
    </xsl:template>

</xsl:stylesheet>