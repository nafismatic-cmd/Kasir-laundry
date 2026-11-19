<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class LaundryCrudController extends Controller
{
    private function modules()
    {
        return [
            'konsumen' => [
                'title' => 'Data Konsumen',
                'table' => 'Konsumen',
                'pk' => 'Kode_Konsumen',
                'search' => 'Nama',
                'columns' => [
                    'Kode_Konsumen' => 'Kode',
                    'Nama' => 'Nama Konsumen',
                    'Alamat' => 'Alamat',
                    'Telepon' => 'Telepon',
                    'No_Transaksi' => 'No. Transaksi',
                ],
                'fields' => [
                    [
                        'name' => 'Kode_Konsumen',
                        'label' => 'Kode Konsumen',
                        'type' => 'number',
                        'rules' => 'required|integer|unique:Konsumen,Kode_Konsumen'
                    ],
                    [
                        'name' => 'Nama',
                        'label' => 'Nama Konsumen',
                        'type' => 'text',
                        'rules' => 'required|string|max:100'
                    ],
                    [
                        'name' => 'Alamat',
                        'label' => 'Alamat',
                        'type' => 'text',
                        'rules' => 'nullable|string|max:200'
                    ],
                    [
                        'name' => 'Telepon',
                        'label' => 'Nomor Telepon',
                        'type' => 'text',
                        'rules' => 'nullable|string|max:20'
                    ],
                    [
                        'name' => 'No_Transaksi',
                        'label' => 'Nomor Transaksi',
                        'type' => 'select',
                        'options' => [
                            'table' => 'Transaksi',
                            'value' => 'No_Transaksi',
                            'label' => 'No_Transaksi'
                        ],
                        'rules' => 'nullable|exists:Transaksi,No_Transaksi'
                    ],
                ],
            ],

            'barang' => [
                'title' => 'Data Barang',
                'table' => 'Barang',
                'pk' => 'Kode_Barang',
                'search' => 'Nama_Barang',
                'columns' => [
                    'Kode_Barang' => 'Kode Barang',
                    'Nama_Barang' => 'Nama Barang',
                    'Stok' => 'Stok',
                    'Tanggal_Update_Stok' => 'Update Stok',
                ],
                'fields' => [
                    [
                        'name' => 'Kode_Barang',
                        'label' => 'Kode Barang',
                        'type' => 'number',
                        'rules' => 'required|integer|unique:Barang,Kode_Barang'
                    ],
                    [
                        'name' => 'Nama_Barang',
                        'label' => 'Nama Barang',
                        'type' => 'text',
                        'rules' => 'required|string|max:100'
                    ],
                    [
                        'name' => 'Stok',
                        'label' => 'Jumlah Stok',
                        'type' => 'number',
                        'rules' => 'required|integer|min:0'
                    ],
                    [
                        'name' => 'Tanggal_Update_Stok',
                        'label' => 'Tanggal Update Stok',
                        'type' => 'date',
                        'rules' => 'nullable|date'
                    ],
                ],
            ],

            'supplier' => [
                'title' => 'Data Supplier',
                'table' => 'Supplier',
                'pk' => 'ID_Supplier',
                'search' => 'Nama',
                'columns' => [
                    'ID_Supplier' => 'ID Supplier',
                    'Nama' => 'Nama Supplier',
                    'Alamat' => 'Alamat',
                    'Telepon' => 'Telepon',
                ],
                'fields' => [
                    [
                        'name' => 'ID_Supplier',
                        'label' => 'ID Supplier',
                        'type' => 'number',
                        'rules' => 'required|integer|unique:Supplier,ID_Supplier'
                    ],
                    [
                        'name' => 'Nama',
                        'label' => 'Nama Supplier',
                        'type' => 'text',
                        'rules' => 'required|string|max:100'
                    ],
                    [
                        'name' => 'Alamat',
                        'label' => 'Alamat',
                        'type' => 'text',
                        'rules' => 'nullable|string|max:200'
                    ],
                    [
                        'name' => 'Telepon',
                        'label' => 'Nomor Telepon',
                        'type' => 'text',
                        'rules' => 'nullable|string|max:20'
                    ],
                ],
            ],

            'tarif' => [
                'title' => 'Data Tarif',
                'table' => 'Tarif',
                'pk' => 'ID_Jenis_Pakaian',
                'search' => 'Nama_Pakaian',
                'columns' => [
                    'ID_Jenis_Pakaian' => 'ID Pakaian',
                    'Nama_Pakaian' => 'Nama Pakaian',
                    'Tarif' => 'Tarif',
                    'ID_Jenis_Laundry' => 'Jenis Laundry',
                ],
                'fields' => [
                    [
                        'name' => 'ID_Jenis_Pakaian',
                        'label' => 'ID Jenis Pakaian',
                        'type' => 'number',
                        'rules' => 'required|integer|unique:Tarif,ID_Jenis_Pakaian'
                    ],
                    [
                        'name' => 'Nama_Pakaian',
                        'label' => 'Nama Pakaian',
                        'type' => 'text',
                        'rules' => 'required|string|max:100'
                    ],
                    [
                        'name' => 'Tarif',
                        'label' => 'Harga Tarif',
                        'type' => 'number',
                        'rules' => 'required|numeric|min:0'
                    ],
                    [
                        'name' => 'ID_Jenis_Laundry',
                        'label' => 'Jenis Laundry',
                        'type' => 'select',
                        'options' => [
                            'table' => 'Jenis_Laundry',
                            'value' => 'ID_Jenis_Laundry',
                            'label' => 'Nama_Jenis_Laundry'
                        ],
                        'rules' => 'required|exists:Jenis_Laundry,ID_Jenis_Laundry'
                    ],
                ],
            ],

            'transaksi' => [
                'title' => 'Data Transaksi',
                'table' => 'Transaksi',
                'pk' => 'No_Transaksi',
                'search' => 'No_Transaksi',
                'columns' => [
                    'No_Transaksi' => 'No. Transaksi',
                    'Tanggal' => 'Tanggal',
                    'Tanggal_Ambil' => 'Tanggal Ambil',
                    'Diskon' => 'Diskon',
                    'Jumlah_Pembayaran' => 'Total Pembayaran',
                ],
                'fields' => [
                    [
                        'name' => 'No_Transaksi',
                        'label' => 'Nomor Transaksi',
                        'type' => 'number',
                        'rules' => 'required|integer|unique:Transaksi,No_Transaksi'
                    ],
                    [
                        'name' => 'Tanggal',
                        'label' => 'Tanggal Transaksi',
                        'type' => 'date',
                        'rules' => 'required|date'
                    ],
                    [
                        'name' => 'Tanggal_Ambil',
                        'label' => 'Tanggal Pengambilan',
                        'type' => 'date',
                        'rules' => 'nullable|date|after_or_equal:Tanggal'
                    ],
                    [
                        'name' => 'Diskon',
                        'label' => 'Diskon',
                        'type' => 'number',
                        'rules' => 'required|numeric|min:0'
                    ],
                    [
                        'name' => 'Jumlah_Pembayaran',
                        'label' => 'Jumlah Pembayaran',
                        'type' => 'number',
                        'rules' => 'required|numeric|min:0'
                    ],
                ],
            ],
        ];
    }

    private function getModule($module)
    {
        $modules = $this->modules();

        abort_unless(isset($modules[$module]), 404);

        return $modules[$module];
    }

    private function getOptions($config)
    {
        $options = [];

        foreach ($config['fields'] as $field) {
            if ($field['type'] === 'select') {
                $source = $field['options'];

                $options[$field['name']] = DB::table($source['table'])
                    ->select(
                        $source['value'],
                        $source['label']
                    )
                    ->get();
            }
        }

        return $options;
    }

    public function index(Request $request, $module)
    {
        $config = $this->getModule($module);

        $query = DB::table($config['table']);

        if ($request->filled('search')) {
            $query->where(
                $config['search'],
                'like',
                '%' . $request->search . '%'
            );
        }

        $rows = $query
            ->orderBy($config['pk'], 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('crud.index', compact(
            'config',
            'rows',
            'module'
        ));
    }

    public function create($module)
    {
        $config = $this->getModule($module);
        $options = $this->getOptions($config);

        return view('crud.form', [
            'config' => $config,
            'module' => $module,
            'item' => null,
            'options' => $options,
            'action' => 'create'
        ]);
    }

    public function store(Request $request, $module)
    {
        $config = $this->getModule($module);

        $rules = [];

        foreach ($config['fields'] as $field) {
            $rules[$field['name']] = $field['rules'];
        }

        $data = $request->validate($rules);

        DB::table($config['table'])->insert($data);

        return redirect()
            ->route('data.index', $module)
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($module, $id)
    {
        $config = $this->getModule($module);

        $item = DB::table($config['table'])
            ->where($config['pk'], $id)
            ->first();

        abort_unless($item, 404);

        $options = $this->getOptions($config);

        return view('crud.form', [
            'config' => $config,
            'module' => $module,
            'item' => $item,
            'options' => $options,
            'action' => 'edit'
        ]);
    }

    public function update(Request $request, $module, $id)
    {
        $config = $this->getModule($module);

        $rules = [];

        foreach ($config['fields'] as $field) {
            $rule = $field['rules'];

            if ($field['name'] === $config['pk']) {
                $rule = str_replace(
                    '|unique:' . $config['table'] . ',' . $config['pk'],
                    '',
                    $rule
                );
            }

            $rules[$field['name']] = $rule;
        }

        $data = $request->validate($rules);

        unset($data[$config['pk']]);

        DB::table($config['table'])
            ->where($config['pk'], $id)
            ->update($data);

        return redirect()
            ->route('data.index', $module)
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($module, $id)
    {
        $config = $this->getModule($module);

        try {
            DB::table($config['table'])
                ->where($config['pk'], $id)
                ->delete();

            return redirect()
                ->route('data.index', $module)
                ->with('success', 'Data berhasil dihapus!');

        } catch (QueryException $e) {

            return redirect()
                ->route('data.index', $module)
                ->with('error', 'Data tidak bisa dihapus karena masih digunakan oleh data lain.');
        }
    }
}
