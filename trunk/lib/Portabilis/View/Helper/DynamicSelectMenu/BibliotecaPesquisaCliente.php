<?php
#error_reporting(E_ALL);
#ini_set("display_errors", 1);
/**
 * i-Educar - Sistema de gestão escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itajaí
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa é software livre; você pode redistribuí-lo e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a versão 2 da Licença, como (a seu critério)
 * qualquer versão posterior.
 *
 * Este programa é distribuí­do na expectativa de que seja útil, porém, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia implí­cita de COMERCIABILIDADE OU
 * ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a Licença Pública Geral
 * do GNU para mais detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral do GNU junto
 * com este programa; se não, escreva para a Free Software Foundation, Inc., no
 * endereço 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas D'Avila <lucasdavila@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Portabilis
 * @since     Arquivo disponível desde a versão 1.1.0
 * @version   $Id$
 */

require_once 'lib/Portabilis/View/Helper/DynamicSelectMenu/Core.php';


/**
 * Portabilis_View_Helper_DynamicSelectMenu_BibliotecaPesquisaCliente class.
 *
 * @author    Lucas D'Avila <lucasdavila@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Portabilis
 * @since     Classe disponível desde a versão 1.1.0
 * @version   @@package_version@@
 */
class Portabilis_View_Helper_DynamicSelectMenu_BibliotecaPesquisaCliente extends Portabilis_View_Helper_DynamicSelectMenu_Core {

public function bibliotecaPesquisaCliente($clienteId, $options = array()) {
    $inputHint = "<img border='0' onclick='pesquisaCliente();' id='lupa_pesquisa_cliente' name='lupa_pesquisa_cliente' src='imagens/lupa.png' />";

    $defaultOptions = array('id'         => 'nome_cliente',
                            'label'      => 'Cliente',
                            'value'      => '',
                            'size'       => '30',
                            'maxLength'  => '255',
                            'required'   => false,
                            'expressao'  => false,
                            'duplo'      => false,
                            'label_hint' => '',
                            'input_hint' => $inputHint,
                            'callback'   => '',
                            'event'      => 'onKeyUp',
                            'disabled'   => true);


    $options = $this->mergeOptions($options, $defaultOptions);
    call_user_func_array(array($this->viewInstance, 'campoTexto'), $options);

    $this->viewInstance->campoOculto("ref_cod_cliente", $clienteId);

    ApplicationHelper::embedJavascript($this->viewInstance, '
      var resetCliente = function(){
        $("#ref_cod_cliente").val("");
        $("#nome_cliente").val("");
      }

      $("#ref_cod_biblioteca").change(resetCliente);', true);

    ApplicationHelper::embedJavascript($this->viewInstance, "
      function pesquisaCliente() {
        if (validatesPresenseOfValueInRequiredFields()) {
	        var bibliotecaId = document.getElementById('ref_cod_biblioteca').value;
	        pesquisa_valores_popless('educar_pesquisa_cliente_lst.php?campo1=ref_cod_cliente&campo2=nome_cliente&ref_cod_biblioteca='+bibliotecaId);
        }
      }
    ");
  }
}
?>
