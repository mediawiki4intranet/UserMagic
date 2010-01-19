<?php
/**
 * @copyright © 2010, Vitaliy Filippov
 * @version 1.1 (2010-01-19)
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2
 * of the License.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * See the GNU General Public License for more details.
 */

if (!defined('MEDIAWIKI'))
    die("This requires the MediaWiki enviroment.");

$wgExtensionCredits['parserhook'][] = array(
    'name'        => 'UserMagic',
    'author'      => 'Vitaliy Filippov',
    'description' => 'Defines several username-producing magic words.',
    'url'         => 'http://yourcmc.ru/wiki/UserMagic_(MediaWiki)',
    'version'     => '1.1'
);

$wgExtensionMessagesFiles['UserMagic'] = dirname(__FILE__) . '/UserMagic.i18n.php';
$wgHooks['MagicWordwgVariableIDs'][] = 'efUserMagicMagicWordwgVariableIDs';
$wgHooks['ParserGetVariableValueSwitch'][] = 'efUserMagicParserGetVariableValueSwitch';

function efUserMagicMagicWordwgVariableIDs(&$mVariablesIDs)
{
    wfLoadExtensionMessages('UserMagic');
    $mVariablesIDs[] = 'username';
    $mVariablesIDs[] = 'userip';
    return true;
}

function efUserMagicParserGetVariableValueSwitch(&$parser, &$varCache, &$index, &$ret)
{
    global $wgUser;
    if ($index == 'username')
    {
        $ret = $wgUser->getName();
        return true;
    }
    else if ($index == 'userip')
    {
        $ret = wfGetIP();
        return true;
    }
    return false;
}
