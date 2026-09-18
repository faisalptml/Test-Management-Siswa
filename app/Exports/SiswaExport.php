<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromQuery, WithHeadings, WithMapping
{
    protected ?string $search;
    protected ?string $lembaga;

    public function __construct(
        ?string $search = null,
        ?string $lembaga = null
    ) {
        $this->search = $search;
        $this->lembaga = $lembaga;
    }

    public function query(): Builder
    {
        return Siswa::query()
            ->with('lembaga')

            ->when($this->search, function (Builder $query) {

                $search = $this->search;

                $query->where(function (Builder $query) use ($search) {

                    $query->where('nis', 'like', '%' . $search . '%')
                        ->orWhere(
                            'nama_siswa',
                            'like',
                            '%' . $search . '%'
                        );

                });

            })

            ->when($this->lembaga, function (Builder $query) {

                $lembaga = $this->lembaga;

                $query->whereHas('lembaga', function (Builder $query) use ($lembaga) {

                    $query->where('nama_lembaga', $lembaga);

                });

            })

            ->orderBy('id');
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama Siswa',
            'Email',
            'Lembaga',
        ];
    }

    public function map($siswa): array
    {
        static $no = 0;

        $no++;

        return [
            $no,
            $siswa->nis,
            $siswa->nama_siswa,
            $siswa->email,
            $siswa->lembaga->nama_lembaga ?? '-',
        ];
    }
}
