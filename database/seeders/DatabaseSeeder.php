<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | AUTORES
        |--------------------------------------------------------------------------
        */

        $datosAutores = [
            [
                'nombre' => 'Mario',
                'apellido' => 'Vargas Llosa',
                'nacionalidad' => 'Peruana',
                'fecha_nacimiento' => '1936-03-28',
            ],
            [
                'nombre' => 'Gabriel',
                'apellido' => 'García Márquez',
                'nacionalidad' => 'Colombiana',
                'fecha_nacimiento' => '1927-03-06',
            ],
            [
                'nombre' => 'Julio',
                'apellido' => 'Cortázar',
                'nacionalidad' => 'Argentina',
                'fecha_nacimiento' => '1914-08-26',
            ],
            [
                'nombre' => 'Isabel',
                'apellido' => 'Allende',
                'nacionalidad' => 'Chilena',
                'fecha_nacimiento' => '1942-08-02',
            ],
            [
                'nombre' => 'Jorge Luis',
                'apellido' => 'Borges',
                'nacionalidad' => 'Argentina',
                'fecha_nacimiento' => '1899-08-24',
            ],
            [
                'nombre' => 'Pablo',
                'apellido' => 'Neruda',
                'nacionalidad' => 'Chilena',
                'fecha_nacimiento' => '1904-07-12',
            ],
            [
                'nombre' => 'Miguel',
                'apellido' => 'de Cervantes',
                'nacionalidad' => 'Española',
                'fecha_nacimiento' => '1547-09-29',
            ],
            [
                'nombre' => 'Jane',
                'apellido' => 'Austen',
                'nacionalidad' => 'Británica',
                'fecha_nacimiento' => '1775-12-16',
            ],
            [
                'nombre' => 'Franz',
                'apellido' => 'Kafka',
                'nacionalidad' => 'Checa',
                'fecha_nacimiento' => '1883-07-03',
            ],
            [
                'nombre' => 'Antoine',
                'apellido' => 'de Saint-Exupéry',
                'nacionalidad' => 'Francesa',
                'fecha_nacimiento' => '1900-06-29',
            ],
        ];

        $autores = collect();

        foreach ($datosAutores as $datos) {
            $autor = Autor::firstOrCreate(
                [
                    'nombre' => $datos['nombre'],
                    'apellido' => $datos['apellido'],
                ],
                $datos
            );

            $autores->push($autor);
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORÍAS
        |--------------------------------------------------------------------------
        */

        $datosCategorias = [
            [
                'nombre' => 'Novela',
                'descripcion' => 'Obras narrativas de ficción.',
            ],
            [
                'nombre' => 'Cuento',
                'descripcion' => 'Narraciones literarias breves.',
            ],
            [
                'nombre' => 'Poesía',
                'descripcion' => 'Obras escritas en verso.',
            ],
            [
                'nombre' => 'Fantasía',
                'descripcion' => 'Historias con elementos fantásticos.',
            ],
            [
                'nombre' => 'Ciencia ficción',
                'descripcion' => 'Historias relacionadas con ciencia y tecnología.',
            ],
            [
                'nombre' => 'Romance',
                'descripcion' => 'Historias centradas en relaciones amorosas.',
            ],
            [
                'nombre' => 'Historia',
                'descripcion' => 'Libros sobre acontecimientos históricos.',
            ],
            [
                'nombre' => 'Biografía',
                'descripcion' => 'Relatos sobre la vida de personas.',
            ],
            [
                'nombre' => 'Aventura',
                'descripcion' => 'Historias de viajes, riesgos y exploraciones.',
            ],
            [
                'nombre' => 'Infantil',
                'descripcion' => 'Libros dirigidos al público infantil.',
            ],
        ];

        $categorias = collect();

        foreach ($datosCategorias as $datos) {
            $categoria = Categoria::firstOrCreate(
                ['nombre' => $datos['nombre']],
                $datos
            );

            $categorias->push($categoria);
        }

        /*
        |--------------------------------------------------------------------------
        | EDITORIALES
        |--------------------------------------------------------------------------
        */

        $datosEditoriales = [
            [
                'nombre' => 'Alfaguara',
                'direccion' => 'Av. Javier Prado 101, Lima',
                'telefono' => '987654301',
            ],
            [
                'nombre' => 'Planeta',
                'direccion' => 'Av. Arequipa 202, Lima',
                'telefono' => '987654302',
            ],
            [
                'nombre' => 'Seix Barral',
                'direccion' => 'Av. Brasil 303, Lima',
                'telefono' => '987654303',
            ],
            [
                'nombre' => 'Penguin Random House',
                'direccion' => 'Av. Larco 404, Lima',
                'telefono' => '987654304',
            ],
            [
                'nombre' => 'Anagrama',
                'direccion' => 'Av. Benavides 505, Lima',
                'telefono' => '987654305',
            ],
            [
                'nombre' => 'Austral',
                'direccion' => 'Av. Canadá 606, Lima',
                'telefono' => '987654306',
            ],
            [
                'nombre' => 'Santillana',
                'direccion' => 'Av. Primavera 707, Lima',
                'telefono' => '987654307',
            ],
            [
                'nombre' => 'Salamandra',
                'direccion' => 'Av. Universitaria 808, Lima',
                'telefono' => '987654308',
            ],
            [
                'nombre' => 'Debolsillo',
                'direccion' => 'Av. Colonial 909, Lima',
                'telefono' => '987654309',
            ],
            [
                'nombre' => 'Norma',
                'direccion' => 'Av. La Marina 1001, Lima',
                'telefono' => '987654310',
            ],
        ];

        $editoriales = collect();

        foreach ($datosEditoriales as $datos) {
            $editorial = Editorial::firstOrCreate(
                ['nombre' => $datos['nombre']],
                $datos
            );

            $editoriales->push($editorial);
        }

        /*
        |--------------------------------------------------------------------------
        | LIBROS
        |--------------------------------------------------------------------------
        */

        $datosLibros = [
            [
                'titulo' => 'La ciudad y los perros',
                'isbn' => '9780000000001',
                'anio_publicacion' => 1963,
                'stock' => 15,
            ],
            [
                'titulo' => 'Cien años de soledad',
                'isbn' => '9780000000002',
                'anio_publicacion' => 1967,
                'stock' => 20,
            ],
            [
                'titulo' => 'Rayuela',
                'isbn' => '9780000000003',
                'anio_publicacion' => 1963,
                'stock' => 12,
            ],
            [
                'titulo' => 'La casa de los espíritus',
                'isbn' => '9780000000004',
                'anio_publicacion' => 1982,
                'stock' => 18,
            ],
            [
                'titulo' => 'El Aleph',
                'isbn' => '9780000000005',
                'anio_publicacion' => 1949,
                'stock' => 10,
            ],
            [
                'titulo' => 'Veinte poemas de amor',
                'isbn' => '9780000000006',
                'anio_publicacion' => 1924,
                'stock' => 25,
            ],
            [
                'titulo' => 'Don Quijote de la Mancha',
                'isbn' => '9780000000007',
                'anio_publicacion' => 1605,
                'stock' => 8,
            ],
            [
                'titulo' => 'Orgullo y prejuicio',
                'isbn' => '9780000000008',
                'anio_publicacion' => 1813,
                'stock' => 14,
            ],
            [
                'titulo' => 'La metamorfosis',
                'isbn' => '9780000000009',
                'anio_publicacion' => 1915,
                'stock' => 16,
            ],
            [
                'titulo' => 'El principito',
                'isbn' => '9780000000010',
                'anio_publicacion' => 1943,
                'stock' => 30,
            ],
        ];

        $libros = collect();

        foreach ($datosLibros as $indice => $datos) {
            $libro = Libro::firstOrCreate(
                ['isbn' => $datos['isbn']],
                [
                    'titulo' => $datos['titulo'],
                    'isbn' => $datos['isbn'],
                    'anio_publicacion' => $datos['anio_publicacion'],
                    'stock' => $datos['stock'],
                    'autor_id' => $autores[$indice]->id,
                    'categoria_id' => $categorias[$indice]->id,
                    'editorial_id' => $editoriales[$indice]->id,
                ]
            );

            $libros->push($libro);
        }

        /*
        |--------------------------------------------------------------------------
        | PRÉSTAMOS
        |--------------------------------------------------------------------------
        */

        $datosPrestamos = [
            [
                'nombre_estudiante' => 'Ana Torres',
                'fecha_prestamo' => '2026-07-01',
                'fecha_devolucion' => '2026-07-08',
            ],
            [
                'nombre_estudiante' => 'Carlos Mendoza',
                'fecha_prestamo' => '2026-07-02',
                'fecha_devolucion' => '2026-07-09',
            ],
            [
                'nombre_estudiante' => 'Lucía Ramírez',
                'fecha_prestamo' => '2026-07-03',
                'fecha_devolucion' => '2026-07-10',
            ],
            [
                'nombre_estudiante' => 'José Castillo',
                'fecha_prestamo' => '2026-07-04',
                'fecha_devolucion' => '2026-07-11',
            ],
            [
                'nombre_estudiante' => 'María Flores',
                'fecha_prestamo' => '2026-07-05',
                'fecha_devolucion' => '2026-07-12',
            ],
            [
                'nombre_estudiante' => 'Pedro Sánchez',
                'fecha_prestamo' => '2026-07-06',
                'fecha_devolucion' => '2026-07-13',
            ],
            [
                'nombre_estudiante' => 'Rosa Chávez',
                'fecha_prestamo' => '2026-07-07',
                'fecha_devolucion' => '2026-07-14',
            ],
            [
                'nombre_estudiante' => 'Luis Herrera',
                'fecha_prestamo' => '2026-07-08',
                'fecha_devolucion' => '2026-07-15',
            ],
            [
                'nombre_estudiante' => 'Sofía Vargas',
                'fecha_prestamo' => '2026-07-09',
                'fecha_devolucion' => '2026-07-16',
            ],
            [
                'nombre_estudiante' => 'Diego Rojas',
                'fecha_prestamo' => '2026-07-10',
                'fecha_devolucion' => '2026-07-17',
            ],
        ];

        foreach ($datosPrestamos as $indice => $datos) {
            Prestamo::firstOrCreate(
                [
                    'nombre_estudiante' => $datos['nombre_estudiante'],
                    'libro_id' => $libros[$indice]->id,
                ],
                [
                    'nombre_estudiante' => $datos['nombre_estudiante'],
                    'fecha_prestamo' => $datos['fecha_prestamo'],
                    'fecha_devolucion' => $datos['fecha_devolucion'],
                    'libro_id' => $libros[$indice]->id,
                ]
            );
        }
    }
}