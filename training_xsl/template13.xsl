<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">

        <table>
            <xsl:for-each select="//description[position() mod 2 = 1]">
                <tr>
                    <td><xsl:value-of select="." /></td>
                    <td><xsl:value-of select="following-sibling::description" /></td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>

</xsl:stylesheet>