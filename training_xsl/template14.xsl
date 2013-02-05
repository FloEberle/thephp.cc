<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">

        <table>
            <xsl:for-each select="//description[position() mod 2 = 1]">
                <tr>
                    <xsl:apply-templates select=".|following-sibling::description[1]" />
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>

    <xsl:template match="description">
        <td><xsl:value-of select="." /></td>
    </xsl:template>

</xsl:stylesheet>