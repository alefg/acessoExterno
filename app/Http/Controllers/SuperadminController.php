<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Orgao;
use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperadminController extends Controller
{
    public function __construct()
    {
        // Garante que apenas superadmins acessem este controller
        $this->middleware(['auth', 'superadmin']); // Um middleware 'superadmin' precisará ser criado
    }

    public function dashboard()
    {
        $stats = [
            'total_solicitacoes' => Solicitacao::count(),
            'solicitacoes_pendentes' => Solicitacao::where('status', 'pendente')->count(),
            'total_orgaos' => Orgao::count(),
            'total_usuarios' => User::count(),
        ];
        return view('superadmin.dashboard', compact('stats'));
    }

    // --- Gerenciamento de Solicitações ---
    public function listarSolicitacoes()
    {
        $solicitacoes = Solicitacao::with('orgao', 'area')->latest()->paginate(20);
        return view('superadmin.solicitacoes.index', compact('solicitacoes'));
    }

    // --- Gerenciamento de Órgãos ---
    public function listarOrgaos()
    {
        $orgaos = Orgao::withCount('areas', 'users')->paginate(10);
        return view('superadmin.orgaos.index', compact('orgaos'));
    }

    public function storeOrgao(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:255|unique:orgaos']);
        Orgao::create($request->only('nome'));
        return back()->with('success', 'Órgão criado com sucesso.');
    }

    // --- Gerenciamento de Áreas ---
    public function listarAreas()
    {
        $areas = Area::with('orgao')->paginate(15);
        $orgaos = Orgao::all();
        return view('superadmin.areas.index', compact('areas', 'orgaos'));
    }

    public function storeArea(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'orgao_id' => 'required|exists:orgaos,id'
        ]);
        Area::create($request->only('nome', 'orgao_id'));
        return back()->with('success', 'Área criada com sucesso.');
    }

    // --- Gerenciamento de Usuários ---
    public function listarUsuarios()
    {
        $usuarios = User::with('orgao', 'area')->paginate(15);
        $orgaos = Orgao::all();
        $areas = Area::all();
        return view('superadmin.usuarios.index', compact('usuarios', 'orgaos', 'areas'));
    }

    public function storeUsuario(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:responsavel,superadmin'],
            'orgao_id' => ['required_if:role,responsavel', 'nullable', 'exists:orgaos,id'],
            'area_id' => ['required_if:role,responsavel', 'nullable', 'exists:areas,id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'orgao_id' => $request->orgao_id,
            'area_id' => $request->area_id,
        ]);

        return back()->with('success', 'Usuário criado com sucesso.');
    }
}