<?php
namespace App\Controllers;
//namespace App\ClientesModel;
use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
    protected $clientes;
    protected $reglas;
    public function __construct()
    {
        $this->clientes = new ClientesModel();

        helper(['form']);

        $this->reglas =[
            'nombre' =>[
               'rules' =>'required',
               'errors' => [
                      'required' => 'El campo {field} es obligatorio.',
            ]
        ]
        ];

    }
    
    public function index($activo = 1)
    {
        $clientes = $this->clientes->where('activo',$activo)->findAll();
        $data = ['titulo' => 'clientes', 'datos' => $clientes];

        echo view('header');
        echo view('clientes/clientes', $data);
        echo view('footer');
    }
    public function eliminados($activo = 0)
    {
        $clientes = $this->clientes->where('activo',$activo)->findAll();
        $data = ['titulo' => 'clientes eliminados','datos' => $clientes];

        echo view('header');
        echo view('clientes/eliminados', $data);
        echo view('footer');
    }
    public function nuevo()
    {
        $data = ['titulo' =>  'Agregar cliente'];

        echo view('header');
        echo view('clientes/nuevo', $data);
        echo view('footer');
    }
    public function insertar()
    {
        if($this->request->getMethod() == "post" && $this->validate($this->reglas)){

        $this->clientes->save([
        'nombre' => $this->request->getPost('nombre'),
        'direccion' => $this->request->getPost('direccion'),
        'telefono' => $this->request->getPost('telefono'),
        'correo' => $this->request->getPost('correo')]);
        return redirect()->to(base_url().'/clientes');
        }else {
        $data = ['titulo' =>  'Agregar cliente', 'validation' =>$this->validator];
        
        echo view('header');
        echo view('clientes/nuevo', $data);
        echo view('footer');
        }
    }
    public function editar($id)
    {
        $cliente = $this->clientes->where('id' , $id)->first();
        $data = ['titulo' => 'Editar cliente','cliente' => $cliente];

        echo view('header');
        echo view('clientes/editar', $data);
        echo view('footer');
    }
    public function actualizar()
    {
        $this->clientes->update($this->request->getPost('id'),
        ['nombre' => $this->request->getPost('nombre'),
        'direccion' => $this->request->getPost('direccion'),
        'telefono' => $this->request->getPost('telefono'),
        'correo' => $this->request->getPost('correo')]);
        
        return redirect()->to(base_url().'/clientes');
    }
    public function eliminar($id)
    {
       $model = new ClientesModel();
       $model->delete($id);
       session()->setFlashdata('mensaje', 'Caja Eliminada');
        return redirect()->to(base_url().'/clientes');
    }
    public function reingresar($id)
    {
        $this->clientes->update($id, ['activo' => 1]);
        return redirect()->to(base_url().'/clientes');
    }

}