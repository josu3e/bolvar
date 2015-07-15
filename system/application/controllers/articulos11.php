<?php
class articulos extends Controller
{
  function __construct()
  {
    parent::Controller();
		if(!$this->dx_auth->is_logged_in() && !$this->session->userdata('DX_user_id'))
		{
      redirect('autenticacion/flash');
		}
    $this->load->library('pagination');
    $this->load->library('form_validation');
		$this->load->model('articulos_model', 'articulos');
		$this->load->model('logotipo_model', 'logotipo');
		$this->load->model('usuarios_model', 'usuario');
		$this->load->model('categorias_model', 'categoria');
  }

  function index()
  {
    if(!$this->session->userdata('cart'))
      $this->session->set_userdata('cart', array());
    $this->lapiceros();
  }

	function lapiceros()
	{
	  $uri = $this->uri;
    $tipo = 1;
    $data['title'] = 'Bolivar International - Lapiceros';
    $data['extra_css'] = link_tag('css/_cotizar.css')."\n";

    // Valores por defecto
    $def_cat = $this->articulos->default_categoria($tipo);
    if(count($def_cat) > 0)
		{
      $cat = $this->uri->segment(3, $def_cat['cat_key']);
      $def_col = $this->articulos->default_color($tipo, $cat);
      if(count($def_col) > 0)
      {
        $col = $uri->segment(4, $def_col['col_key']);
        // $def_log = $this->articulos->default_logo($this->session->userdata('DX_user_id'));
        $def_log = array('log_key'=>'no-logo');
        $log = $uri->segment(5, $def_log['log_key']);
        $cart = $this->session->userdata('cart');

        $config['base_url'] = site_url('articulos/lapiceros/'.$cat.'/'.$col.'/'.$log);
        $config['total_rows'] = $this->articulos->count_all_articulos($tipo, $cat, $col);
        $config['per_page'] = '15';
        $config['uri_segment'] = '6';
        $config['num_links'] = '5';

        $cont['articulos'] = $this->articulos->get_all_articulos($tipo, $cat, $col, $log, $cart, $config['per_page'], $uri->segment(6));
        $this->pagination->initialize($config);
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];

        $cont['categorias'] = $this->articulos->get_categorias($tipo, $cat);
        $cont['colores'] = $this->articulos->get_colores($tipo, $cat);
        $cont['logos'] = $this->articulos->get_logos($cat, $col, $this->session->userdata('DX_user_id'));

        // $cont['parameters'] = 'Cat: '.$cat.' Col: '.$col.' Log:'.$log;

        $data['contenido'] = $this->load->view('articulos/lapiceros', $cont, TRUE);
        $this->load->view('template_base', $data);
      }
      else
      {
        $cont['categorias'] = $this->articulos->get_categorias($tipo, $cat);
        $cont['articulos'] = '<div class="nada"><img src="/img/ico_dreieck.png" height="63" width="66"><p style="font-size:16px;margin:25px 75px;">No se hallaron art&iacute;culos en esta categoría, intente en otra categoría.</p></div>';
        $data['contenido'] = $this->load->view('articulos/lapiceros', $cont, TRUE);
        $this->load->view('template_base', $data);
      }
		}
		else
		{
      $cont['articulos'] = '<div class="nada"><img src="/img/ico_dreieck.png" height="63" width="66"><p style="font-size:16px;margin:25px 75px;">No se hallaron art&iacute;culos en esta categoría, intente en otra categoría.</p></div>';
      $data['contenido'] = $this->load->view('articulos/lapiceros', $cont, TRUE);
      $this->load->view('template_base', $data);
		}
	}
	
  function gimmix()
  {
    $uri = $this->uri;
    $tipo = 2;
    $data['title'] = 'Bolivar International - Gimmix';
    $data['extra_css'] = link_tag('css/_cotizar.css')."\n";

    // Valores por defecto
    $def_cat = $this->articulos->default_categoria($tipo);
    if(count($def_cat) > 0)
		{
      $cat = $this->uri->segment(3, $def_cat['cat_key']);
      $col = '';
      $log = 'gimm';
      $cart = $this->session->userdata('cart');

      $config['base_url'] = site_url('articulos/gimmix/'.$cat);
      $config['total_rows'] = $this->articulos->count_all_articulos($tipo, $cat, $col);
      $config['per_page'] = '15';
      $config['uri_segment'] = '4';
      $config['num_links'] = '5';
      $contador = $this->articulos->get_all_articulos($tipo, $cat, $col, $log, $cart, $config['per_page'], $uri->segment(4), FALSE);
      if(count($contador) >= 1)
      {
        $cont['articulos'] = $this->articulos->get_all_articulos($tipo, $cat, $col, $log, $cart, $config['per_page'], $uri->segment(4));
      
        $this->pagination->initialize($config);
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];

        // $cont['parameters'] = 'Cat: '.$cat.' Col: '.$col.' Log:'.$log;

        $cont['categorias'] = $this->articulos->get_categorias($tipo, $cat);
        $data['contenido'] = $this->load->view('articulos/gimmix', $cont, TRUE);
        $this->load->view('template_base', $data);
      }
      else
      {
        $cont['categorias'] = $this->articulos->get_categorias($tipo, $cat);
        $cont['articulos'] = '<div class="nada"><img src="/img/ico_dreieck.png" height="63" width="66"><p style="font-size:16px;margin:25px 75px;">No se hallaron art&iacute;culos en esta categoría, intente en otra categoría.</p></div>';
        $data['contenido'] = $this->load->view('articulos/gimmix', $cont, TRUE);
        $this->load->view('template_base', $data);
      }
		}
		else
		{
      $cont['categorias'] = $this->articulos->get_categorias($tipo, $cat);
      $cont['articulos'] = '<div class="nada"><img src="/img/ico_dreieck.png" height="63" width="66"><p style="font-size:16px;margin:25px 75px;">No se hallaron art&iacute;culos en esta categoría, intente en otra categoría.</p></div>';
      $data['contenido'] = $this->load->view('articulos/gimmix', $cont, TRUE);
      $this->load->view('template_base', $data);
		}
  }

  function add_cart($art_logo='gimm', $qty=1)
  {
    // list($id, $art, $logo) = explode("_", $art_logo);
    list($id,$art,$logo,$nega,$des) = explode("_", $art_logo);
    $cart = $this->session->userdata('cart');
    // $cart[$art.'_'.$logo] = array($art, $logo, $qty);
    $cart[$art.'_'.$logo] = array($art,$logo,$qty,$nega,$des);
    $this->session->set_userdata('cart', $cart);
  }

  function del_cart($art_logo, $extra='')
  {
    list($id, $art, $logo) = explode("_", $art_logo);
    $cart = $this->session->userdata('cart');
    unset($cart[$art.'_'.$logo]);
    $this->session->set_userdata('cart', $cart);
    if(!empty($extra))
      redirect('articulos/cotizacion');
  }
  
  function upd_cart($cod, $val)
  {
    $cart = $this->session->userdata('cart');
    $cart[substr($cod,3)][2] = $val;
    $this->session->set_userdata('cart', $cart);
    $data['msje'] = 'La cantidad fue actualizada correctamente';
    $this->load->view('mensaje', $data);
  }

	function valida()
	{
	// (isset($this->articulos->valida_negativo($ar[0]) == 1))?$this->logotipo->logo_negativo($id_usu):$this->logotipo->logo($id_usu)
	}
	
  function cotizacion()
  {
    $data['title'] = 'Bolivar International - Cotización';
    $data['extra_css'] = link_tag('css/_cotizar.css')."\n";

    $cart = $this->session->userdata('cart');
    $articulos = '';
    foreach($cart as $ar)
    {
      $a = $this->articulos->get_articulo($ar[0]);
      $carp = $a['art_tar_id']==1?'lapiceros':'gimmix';
      $art = array('src'=>'img/articulos/'.$carp.'/'.$a['art_imagen'], 'width'=>'200', 'alt'=>'');
      $articulos .= '
      <tr>
        <td>'.$ar[4].'</td>
        <td>'.img($art).'</td>
        
        <td><img src="'.base_url().'img/logotipos/'.$this->logotipo->logo($ar[3],$this->session->userdata('DX_user_id'),$ar[1]).'"/></td>

        <td><input name="textfield" type="text" id="id_'.$ar[0].'_'.$ar[1].'" class="upd_cart" size="8" value="'.$ar[2].'"/></td>
        <td>'.anchor('articulos/del_cart/id_'.$ar[0].'_'.$ar[1].'/cotizacion', ' ', 'class="div_boton"').'</td>
      </tr>
      ';
    }

    $cont['articulos'] = $articulos;
    $data['contenido'] = $this->load->view('articulos/cotizacion', $cont, TRUE);
    $this->load->view('template_base', $data);
  }
  
  function enviar_cotizacion()
  {
    $data['title'] = 'Bolivar International - Cotización enviada';
    $data['extra_css'] = link_tag('css/_cotizar.css')."\n";
    $from = $this->session->userdata('DX_email');
    
		// $to = 'ventas@bolivarinternational.com ';
		// $to = 'josue@gurami.net';
    // $mail = $this->usuario->get_email_admin();
		// if( $mail != '')
		// {
      // $to = $mail;
		// }
    // $to = 'joshuaxd@gmail.com';
    $to = 'mysuel77@gmail.com';
		
    $subject = 'Solicitud de cotizacion';
    
    $cart = $this->session->userdata('cart');
    $message = 'El cliente: '.$this->session->userdata('DX_username').' a solicitado la cotización siguiente: '."\n".'
      <table width="600" border="0" cellpadding="5" cellspacing="0">
      <tr><th><b>ID Articulo</b></th><th><b>Imagen</b></th><th><b>Logo</b></th><th><b>Cantidad</b></th></tr>';
    foreach($cart as $art)
    {
      $a = $this->articulos->get_articulo($art[0]);
      $carp = $a['art_tar_id']==1?'lapiceros':'gimmix';
      $logo = $this->logotipo->logo($art[3],$this->session->userdata('DX_user_id'),$art[1]);
      // $art_img = array('src'=>'img/articulos/'.$carp.'/'.$a['art_imagen'], 'width'=>'200', 'alt'=>'');
      
      $message .= '<tr>
      <td align="center"> '.$art[0].'</td>
      <td align="center"><img src="http://www.bolivarinternational.com/img/articulos/'.$carp.'/'.$a["art_imagen"].'"/></td>
      <td align="center"><img src="http://www.bolivarinternational.com/img/logotipos/'.$logo.'"/></td>
      <td align="center"> '.$art[2]."</td></tr> \n";
    }
    $message .= "</table>";
    // $message = str_replace('=3D"', '', $message);
		if($to != '')
		{
		 $this->_email($from, $to, $subject, $message);
		 $msj = 'su cotización fue enviada correctamente.<br/><br/>En breves momentos estará recibiendo la cotización solicitada a su correo electrónico.';
		}
   else
	 {
	 $msj = 'Error en el envio.';
	 }
    // $this->email->send();
		$cont['msj'] = $msj; 
    $data['contenido'] = $this->load->view('articulos/cotizacion_enviada',$cont, TRUE);
    $this->load->view('template_base', $data);
  }
  
	function _email($from, $to, $subject, $message)
	{
		$this->load->library('email');
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'mail.gsp-peru.com';
    $config['smtp_port']    = '587';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'webmaster@gsp-peru.com';
    $config['smtp_pass']    = 'gsp8115';
    $config['charset']    = 'iso-8859-1';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validate'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);
		$email = $this->email;

		$email->from($from);
		$email->to($to);
		$email->subject($subject);
    // $message = str_replace('3D', '', $message);
		$email->message($message);

		$email->send();
    return $this->email->print_debugger();
	}
}

/* End of file articulos.php */
/* Location: ./system/application/controllers/articulos.php */