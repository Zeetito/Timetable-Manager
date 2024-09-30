<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            //  COLLEGE OF AGRICULTURE AND NATURAL RESOURCES
            // FACULTY OF AGRICULTURE 1

            //  Programs without Departments in this Faculty
            ['name' => '101 BSc. Agriculture', 'department_id' => null, ],
            ['name' => '880 BSc. Agricultural Biotechnology', 'department_id' => null, ],
            ['name' => '886 BSc. Agribusiness Management', 'department_id' => null, ],
            ['name' => '879 BSc. Landscape Design and Management', 'department_id' => null, ],

            // Department of Animal Science 1
            ['name' => 'MPhil. Animal Breeding and Genetics', 'department_id' => 1, ],
            ['name' => 'MPhil. Reproductive Physiology', 'department_id' => 1, ],
            ['name' => 'MPhil. Animal Nutrition', 'department_id' => 1, ],
            ['name' => 'MPhil. Meat Science', 'department_id' => 1, ],
            ['name' => 'PhD. Animal Breeding and Genetics', 'department_id' => 1, ],
            ['name' => 'PhD. Reproductive Physiology', 'department_id' => 1, ],
            ['name' => 'PhD. Animal Nutrition', 'department_id' => 1, ],
            ['name' => 'PhD. Meat Science', 'department_id' => 1, ],
            ['name' => 'MPhil. Agricultural Extension and Development Communication', 'department_id' => 1, ],
            ['name' => 'PhD. Agribusiness Management', 'department_id' => 1, ],
            ['name' => 'PhD. Agricultural Extension and Development Communication', 'department_id' => 1, ],

            // Department of Agricultural Economics, Agribusiness and Extension 2
            ['name' => 'MSc. Agribusiness Management', 'department_id' => 2, ],
            ['name' => 'MSc. Agricultural Extension and Development Communication', 'department_id' => 2, ],
            ['name' => 'MPhil. Agribusiness Management', 'department_id' => 2, ],
            ['name' => 'MPhil. Agricultural Economics', 'department_id' => 2, ],
            ['name' => 'MPhil. Agricultural Extension and Development Communication', 'department_id' => 2, ],
            ['name' => 'PhD. Agribusiness Management', 'department_id' => 2, ],
            ['name' => 'PhD. Agricultural Extension and Development Communication', 'department_id' => 2, ],
            ['name' => 'PhD. Agricultural economics', 'department_id' => 2, ],

            // Department of Crop and Soil Sciences 3
            ['name' => 'MPhil. Agronomy', 'department_id' => 3, ],
            ['name' => 'MPhil. Agronomy (Crop Physiology)', 'department_id' => 3, ],
            ['name' => 'MPhil. Crop Protection (Entomology)', 'department_id' => 3, ],
            ['name' => 'MPhil. Crop Protection (Nematology)', 'department_id' => 3, ],
            ['name' => 'MPhil. Crop Protection (Plant Pathology)', 'department_id' => 3, ],
            ['name' => 'MPhil. Crop Protection (Plant Virology)', 'department_id' => 3, ],
            ['name' => 'MPhil. Plant Breeding', 'department_id' => 3, ],
            ['name' => 'MPhil. Soil Science', 'department_id' => 3, ],
            ['name' => 'PhD. Agronomy', 'department_id' => 3, ],
            ['name' => 'PhD. Crop Physiology', 'department_id' => 3, ],
            ['name' => 'PhD. Nematology', 'department_id' => 3, ],
            ['name' => 'PhD. Plant Breeding', 'department_id' => 3, ],
            ['name' => 'PhD. Plant Entomology', 'department_id' => 3, ],
            ['name' => 'PhD. Plant Pathology', 'department_id' => 3, ],
            ['name' => 'PhD. Plant Virology', 'department_id' => 3, ],
            ['name' => 'PhD. Soil Science', 'department_id' => 3, ],

            // Department of Horticulture 4
            ['name' => 'MPhil. Postharvest Technology', 'department_id' => 4, ],
            ['name' => 'MPhil. Seed Science and Technology', 'department_id' => 4, ],
            ['name' => 'MPhil. Fruit Crops Production', 'department_id' => 4, ],
            ['name' => 'MPhil. Vegetable Crops Production', 'department_id' => 4, ],
            ['name' => 'MPhil. Landscape Studies', 'department_id' => 4, ],
            ['name' => 'PhD. Postharvest Technology', 'department_id' => 4, ],
            ['name' => 'PhD. Seed Science and Technology', 'department_id' => 4, ],
            ['name' => 'PhD. Fruit Crops Production', 'department_id' => 4, ],
            ['name' => 'PhD. Landscape Studies', 'department_id' => 4, ],
            ['name' => 'PhD. Vegetable Crops Production', 'department_id' => 4, ],

            // FACULTY OF RENEWABLE NATURAL RESOURCES  2
            //      Programs without Department in this faculty
            ['name' => '108 BSc. Natural Resource Management', 'department_id' => null, ],
            ['name' => '735 BSc. Forest Resources Technology', 'department_id' => null, ],
            ['name' => '741 BSc. Packaging Technology', 'department_id' => null, ],
            ['name' => '1045 BSc. Aquaculture and Water Resource Management', 'department_id' => null, ],

            //  Department of Wildlife and Range Management  5
            ['name' => 'MPhil. Wildlife and Range Management', 'department_id' => 5, ],
            ['name' => 'MSc. Geo Information Science for Natural Resources Management', 'department_id' => 5, ],
            ['name' => 'PhD. Wildlife and Range Management', 'department_id' => 5, ],

            //  Department of Silviculture and Forest Management 6
            ['name' => 'MPhil. Natural Resources and Environmental Governance', 'department_id' => 6, ],
            ['name' => 'MPhil. Silviculture and Forest Management', 'department_id' => 6, ],
            ['name' => 'PhD. Silviculture and Forest Management', 'department_id' => 6, ],

            //  Department of Agroforestry 7
            ['name' => 'MPhil. Agroforestry',  'department_id' => 7, ],
            ['name' => 'PhD. Agroforestry',  'department_id' => 7, ],

            //  Department of Wood Science and Technology Management  8
            ['name' => 'MPhil. Packaging Technology and Management', 'department_id' => 8, ],
            ['name' => 'MPhil. Wood Science and Technology', 'department_id' => 8, ],

            // Department of Fisheries and Watershed Management 9
            ['name' => 'MPhil. Aquaculture and Environment', 'department_id' => 9, ],
            ['name' => 'MPhil. Fisheries Management', 'department_id' => 9, ],
            ['name' => 'MPhil. Watershed Management', 'department_id' => 9, ],
            ['name' => 'PhD. Aquaculture and Environment', 'department_id' => 9, ],
            ['name' => 'PhD. Fisheries Management', 'department_id' => 9, ],
            ['name' => 'PhD. Watershed Management', 'department_id' => 9, ],

            // COLLEGE OF ART AND BUILT ENVIRONMENT
            // FACULTY OF BUILT ENVIRONMENT 3
            //    Programs without department
            ['name' => '205 BSc. Architecture', 'department_id' => null, ],
            ['name' => '853 BSc. Construction Technology and Management', 'department_id' => null, ],
            ['name' => '854 BSc. Quantity Surveying and Construction Economics', 'department_id' => null, ],
            ['name' => '306 BSc. Development Planning', 'department_id' => null, ],
            ['name' => '748 BSc. Human Settlement Planning', 'department_id' => null, ],
            ['name' => '307 BSc. Land Economy', 'department_id' => null, ],
            ['name' => '877 BSc. Real Estate', 'department_id' => null, ],

            // Department Of Agriculture 10
            ['name' => 'MSc. Architecture (Top up) One Year', 'department_id' => 10, ],
            ['name' => 'MArch (Master of Architecture)', 'department_id' => 10, ],
            ['name' => 'MPhil Architectural Studies  | Two Years', 'department_id' => 10, ],
            ['name' => 'PhD. Architecture', 'department_id' => 10, ],

            // Department of Construction Technology and Management 11
            ['name' => 'MSc. Construction Management', 'department_id' => 11, ],
            ['name' => 'MPhil. Construction Management', 'department_id' => 11, ],
            ['name' => 'MSc. Procurement Management', 'department_id' => 11, ],
            ['name' => 'MPhil. Procurement Management', 'department_id' => 11, ],
            ['name' => 'PhD. Procurement Management', 'department_id' => 11, ],
            ['name' => 'MSc. Project Management (One Year) vii. MPhil. Project Management', 'department_id' => 11, ],
            ['name' => 'PhD. Project Management', 'department_id' => 11, ],
            ['name' => 'MPhil. Building Technology', 'department_id' => 11, ],
            ['name' => 'PhD. Building Technology', 'department_id' => 11, ],
            ['name' => 'PhD. Construction Management', 'department_id' => 11, ],

            //  Department of Planning 12
            ['name' => 'MSc. Development Planning and Management (SPRING) (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MPhil. Development Planning and Management (SPRING) (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MSc. Development Policy and Planning (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MPhil. Development Policy and Planning (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MSc. Development Studies (Accra and Kumasi Centres  | Weekend', 'department_id' => 12, ],
            ['name' => 'MPhil. Development Studies (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MSc. Planning (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MPhil. Planning (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'MSc. Transportation Planning (Accra and Kumasi Centres   Weekend)', 'department_id' => 12, ],
            ['name' => 'PhD. Development Studies', 'department_id' => 12, ],
            ['name' => 'PhD. Planning', 'department_id' => 12, ],

            //  Department of Land Economy 13
            ['name' => 'MSc. Real Estate (One Year   Weekend)', 'department_id' => 13, ],
            ['name' => 'MSc. Land Governance and Policy (One Year)', 'department_id' => 13, ],
            ['name' => 'MSc. Facilities Management (One Year)', 'department_id' => 13, ],
            ['name' => 'PhD. Land Management and Governance', 'department_id' => 13, ],

            //  FACULTY OF ART 4
            //    Programs without department
            ['name' => '744 BA. Communication Design', 'department_id' => null, ],
            ['name' => '303 BA. Integrated Rural Art and Industry', 'department_id' => null, ],
            ['name' => '304 BA. Publishing Studies', 'department_id' => null, ],
            ['name' => '1373 BA. Metal Product Design', 'department_id' => null, ],
            ['name' => '1276 BA. Textile Design and Technology', 'department_id' => null, ],
            ['name' => '301 BFA. Painting and Sculpture', 'department_id' => null, ],
            ['name' => '192 BSc. Fashion Design', 'department_id' => null, ],
            ['name' => '1444 BSc. Ceramic Technology', 'department_id' => null, ],

            // Department of Painting and Sculpture 14
            ['name' => 'MFA. Painting', 'department_id' => 14, ],
            ['name' => 'MFA. Sculpture', 'department_id' => 14, ],
            ['name' => 'MFA. Painting and Sculpture', 'department_id' => 14, ],
            ['name' => 'MPhil. African Art and Culture', 'department_id' => 14, ],
            ['name' => 'MSc. Creative Art Therapy', 'department_id' => 14, ],
            ['name' => 'MPhil. Creative Art Therapy', 'department_id' => 14, ],
            ['name' => 'PhD. Painting', 'department_id' => 14, ],
            ['name' => 'PhD. Sculpture', 'department_id' => 14, ],
            ['name' => 'PhD. Painting and Sculpture', 'department_id' => 14, ],
            ['name' => 'PhD. African Art and Culture', 'department_id' => 14, ],

            //  Department of Industrial Art 15
            ['name' => 'MFA. Ceramics', 'department_id' => 15, ],
            ['name' => 'MFA. Jewellery and Metalsmithing', 'department_id' => 15, ],
            ['name' => 'MFA. Textiles Design', 'department_id' => 15, ],
            ['name' => 'MPhil. Textile Design Technology', 'department_id' => 15, ],
            ['name' => 'MPhil. Ceramic Technology', 'department_id' => 15, ],
            ['name' => 'MPhil. Fashion Design Technology', 'department_id' => 15, ],
            ['name' => 'PhD. Ceramic Technology', 'department_id' => 15, ],
            ['name' => 'PhD Textile Design Technology', 'department_id' => 15, ],
            ['name' => 'PhD Fashion Design Technology', 'department_id' => 15, ],

            //  Department of Indigenous Art and Technology 16
            ['name' => 'MPhil. Integrated Art', 'department_id' => 16, ],

            // Department of Publishing Studies 17
            ['name' => 'Department of Publishing Studies', 'department_id' => 17, ],
            ['name' => 'MPhil. Publishing Studies', 'department_id' => 17, ],
            ['name' => 'MPhil. Publishing Studies (Top Up', 'department_id' => 17, ],

            //  Department of Communication Design 18
            ['name' => 'MComm. Design', 'department_id' => 18, ],
            ['name' => 'MPhil. Communication Design', 'department_id' => 18, ],
            ['name' => 'PhD. Visual Communication Design', 'department_id' => 18, ],

            //  FACULTY OF EDUCATIONAL STUDIES 5
            //    Programs without department
            ['name' => '1415 B.Ed. Junior High School Education (Mathematics, Science, ICT, Agricultural Science, History, Visual Arts and Geography)', 'department_id' => null, ],

            // Department of Educational Innovations in Science and Technology 19
            ['name' => 'MA. Art Education (Regular/Weekend/Sandwich)', 'department_id' => 19, ],
            ['name' => 'MPhil. Art Education (Regular/Weekend)', 'department_id' => 19, ],
            ['name' => 'MPhil. Art Education (Top Up)', 'department_id' => 19, ],
            ['name' => 'Master of Education (M.Ed.)   General Education (Regular/Sandwich)', 'department_id' => 19, ],
            ['name' => 'MSc. Educational Innovation and Leadership Science (Regular/Sandwich)', 'department_id' => 19, ],
            ['name' => 'MPhil. Educational Innovation and Leadership Science (Regular/Weekend)', 'department_id' => 19, ],
            ['name' => 'PhD. Art Education (Regular/Weekend)', 'department_id' => 19, ],

            //  Department of Teacher Education 20
            ['name' => 'MPhil. Educational Planning and Administration (Regular/Weekend  | 2 years)', 'department_id' => 20, ],
            ['name' => 'MPhil. Educational Planning and Administration Top Up (Weekend   1 year)', 'department_id' => 20, ],
            ['name' => 'EDD. Educational Planning and Administration (Regular)', 'department_id' => 20, ],
            ['name' => 'MPhil. Mathematics Education (Regular/Weekend   2 years)', 'department_id' => 20, ],
            ['name' => 'MPhil. Mathematics Education Top Up (Weekend   1 year)', 'department_id' => 20, ],
            ['name' => 'MPhil. Language Education and Literacy', 'department_id' => 20, ],
            ['name' => 'MPhil. Language Education and Literacy (Top Up)', 'department_id' => 20, ],
            ['name' => 'MPhil. ICT Education (Regular/Weekend  | 2 years)', 'department_id' => 20, ],
            ['name' => 'MPhil. ICT Education Top Up (Weekend  | 1 year)', 'department_id' => 20, ],
            ['name' => 'MPhil. Science Education (Regular/Weekend  | 2 years)', 'department_id' => 20, ],
            ['name' => 'MPhil. Science Education Top Up (Weekend  | 1 year)', 'department_id' => 20, ],
            ['name' => 'PhD. Science Education (Regular)', 'department_id' => 20, ],
            ['name' => 'PhD. ICT Education (Regular)', 'department_id' => 20, ],
            ['name' => 'PhD. Mathematics Education (Regular)', 'department_id' => 20, ],
            ['name' => 'PhD. Language and Literacy Education (Regular)', 'department_id' => 20, ],
            ['name' => 'PhD. Educational Planning and Administration (Regular)', 'department_id' => 20, ],

            // SANDWICH PROGRAMMES (TO BE RUN ONLINE AND FACETO FACE DURING GES VACATION) 21
            ['name' => 'MEd. Higher Education Pedagogy (Online)', 'department_id' => 21, ],
            ['name' => 'Post Graduate Diploma in Education (Online)', 'department_id' => 21, ],
            ['name' => 'Post Graduate Diploma in Education (KNUST STUDENTS ONLY)', 'department_id' => 21, ],
            ['name' => 'MEd. Educational Planning and Administration (Online)', 'department_id' => 21, ],
            ['name' => 'MEd. Mathematics Education (Online)', 'department_id' => 21, ],
            ['name' => 'MEd. ICT Education (Online)', 'department_id' => 21, ],
            ['name' => 'MEd. Science Education (Online)', 'department_id' => 21, ],
            ['name' => 'MEd. Language Education and Literacy (Online)', 'department_id' => 21, ],

            // COLLEGE OF ENGINEERING
            // FACULTY OF CIVIL AND GEO ENGINEERING 6
            //    Programs without Department
            ['name' => '208 BSc. Civil Engineering', 'department_id' => null, ],
            ['name' => '1420 BSc. Civil Engineering (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '737 BSc. Geological Engineering', 'department_id' => null, ],
            ['name' => '226 BSc. Geological Engineering (Obuasi)', 'department_id' => null, ],
            ['name' => '738 BSc. Geomatic Engineering', 'department_id' => null, ],
            ['name' => '227 BSc. Geomatic Engineering (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '546 BSc. Petroleum Engineering', 'department_id' => null, ],

            // Department of Civil Engineering 22
            ['name' => 'MSc. Geotechnical Engineering (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MPhil. Geotechnical Engineering (Full Time)', 'department_id' => 22, ],
            ['name' => 'MSc. Structural Engineering (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MPhil. Structural Engineering (Full Time)', 'department_id' => 22, ],
            ['name' => 'PhD. Geotechnical Engineering', 'department_id' => 22, ],
            ['name' => 'PhD. Structural Engineering', 'department_id' => 22, ],
            ['name' => 'MSc. Disaster Prevention and Management (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MSc. Water Engineering (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MSc. Water Resources Engineering and Management (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MPhil. Water Resources Engineering and Management (FullTime)', 'department_id' => 22, ],
            ['name' => 'MSc. Water Supply Engineering and Management (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MSc. Environmental Sanitation and Waste Management (Regular, Weekend)', 'department_id' => 22, ],
            ['name' => 'MSc. Water Supply and Environmental Sanitation (Full Time)', 'department_id' => 22, ],
            ['name' => 'MPhil. Water Supply and Environmental Sanitation (Full Time)', 'department_id' => 22, ],
            ['name' => 'PhD. Environmental Sanitation and Waste Management', 'department_id' => 22, ],
            ['name' => 'PhD. Water Resources Management', 'department_id' => 22, ],
            ['name' => 'PhD. Water Supply and Treatment Technology', 'department_id' => 22, ],
            ['name' => 'MSc. Transport Systems (Infrastructure and Engineering)', 'department_id' => 22, ],
            ['name' => 'MPhil. Transport Systems (Infrastructure and Engineering)', 'department_id' => 22, ],
            ['name' => 'MSc. Transport Systems (Urban Transport and Operations)', 'department_id' => 22, ],
            ['name' => 'MPhil. Transport Systems (Urban Transport and Operations)', 'department_id' => 22, ],
            ['name' => 'Ph.D. Transport Systems (Infrastructure and Engineering)', 'department_id' => 22, ],
            ['name' => 'Ph.D. Transport Systems (Urban Transport and Operations)', 'department_id' => 22, ],

            // Department of Geomatic Engineering 23
            ['name' => 'MSc. Geomatic Engineering', 'department_id' => 23, ],
            ['name' => 'MPhil. Geomatic Engineering', 'department_id' => 23, ],
            ['name' => 'MPhil. Geographic Information System', 'department_id' => 23, ],
            ['name' => 'PhD. Geomatic Engineering', 'department_id' => 23, ],

            // Department of Petroleum Engineering  24
            ['name' => 'MSc. Petroleum Engineering', 'department_id' => 24, ],
            ['name' => 'MPhil. Petroleum Engineering', 'department_id' => 24, ],
            ['name' => 'MSc. Petroleum Geoscience', 'department_id' => 24, ],
            ['name' => 'MPhil. Petroleum Geoscience', 'department_id' => 24, ],
            ['name' => 'PhD. Petroleum Engineering', 'department_id' => 24, ],

            // Department of Geological Engineering  25
            ['name' => 'MSc. Geophysical Engineering', 'department_id' => 25, ],
            ['name' => 'PhD. Geological Engineering', 'department_id' => 25, ],

            // FACULTY OF ELECTRICAL & COMPUTER ENGINEERING 7
            //   Programs without Department
            ['name' => '871 BSc. Biomedical Engineering', 'department_id' => null, ],
            ['name' => '212 BSc. Computer Engineering', 'department_id' => null, ],
            ['name' => '209 BSc. Electrical/Electronic Engineering', 'department_id' => null, ],
            ['name' => '199 BSc. Electrical/Electronic Engineering (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '732 BSc. Telecommunications Engineering', 'department_id' => null, ],

            // Department of Electrical and Electronic Engineering 26
            ['name' => 'MPhil. Power Systems Engineering', 'department_id' => 26, ],
            ['name' => 'PhD. Electrical Engineering', 'department_id' => 26, ],

            // Department of Computer Engineering 27
            ['name' => 'MPhil. Computer Engineering', 'department_id' => 27, ],
            ['name' => 'PhD. Computer Engineering', 'department_id' => 27, ],

            // Department of Telecommunication Engineering 28
            ['name' => 'MPhil. Telecommunication Engineering', 'department_id' => 28, ],
            ['name' => 'PhD. Telecommunication Engineering', 'department_id' => 28, ],

            // FACULTY OF MECHANICAL & CHEMICAL ENGINEERING 8
            // Programs without Department
            ['name' => '206 BSc. Agricultural Engineering', 'department_id' => null, ],
            ['name' => '881 BSc. Petrochemical Engineering', 'department_id' => null, ],
            ['name' => '207 BSc. Chemical Engineering', 'department_id' => null, ],
            ['name' => '950 BSc. Metallurgical Engineering', 'department_id' => null, ],
            ['name' => '213 2BSc. Materials Engineering', 'department_id' => null, ],
            ['name' => '217 BSc. Materials Engineering (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '1377 BSc. Marine Engineering', 'department_id' => null, ],
            ['name' => '1376 BSc. Industrial Engineering', 'department_id' => null, ],
            ['name' => '1375 BSc. Automobile Engineering', 'department_id' => null, ],
            ['name' => '211 1BSc. Mechanical Engineering', 'department_id' => null, ],
            ['name' => '1421 BSc. Mechanical Engineering (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '214 BSc. Aerospace Engineering', 'department_id' => null, ],

            // Department of Chemical Engineering 29
            ['name' => 'MPhil. Chemical Engineering', 'department_id' => 29, ],
            ['name' => 'PhD. Chemical Engineering', 'department_id' => 29, ],

            // Department of Agricultural and Biosystems Engineering 30
            ['name' => 'MPhil. Agricultural Machinery Engineering', 'department_id' => 30, ],
            ['name' => 'MPhil. Agro Environmental Engineering', 'department_id' => 30, ],
            ['name' => 'MPhil. Bioengineering', 'department_id' => 30, ],
            ['name' => 'MPhil. Food and Post Harvest Engineering', 'department_id' => 30, ],
            ['name' => 'MPhil. Soil and Water Engineering', 'department_id' => 30, ],
            ['name' => 'MPhil. Intellectual Property (MIP)', 'department_id' => 30, ],
            ['name' => 'PhD Agricultural Machinery Engineering', 'department_id' => 30, ],
            ['name' => 'PhD Agro Environmental Engineering', 'department_id' => 30, ],
            ['name' => 'PhD Bioengineering', 'department_id' => 30, ],
            ['name' => 'PhD Food and Post Harvest Engineering', 'department_id' => 30, ],
            ['name' => 'PhD Soil and Water Engineering', 'department_id' => 30, ],

            // Department of Mechanical Engineering 31
            ['name' => 'MPhil. Mechanical Eng. (Thermo Fluids and Energy Systems) TopUp', 'department_id' => 31, ],
            ['name' => 'MPhil. Mechanical Eng. (Applied Mechanics) Top Up', 'department_id' => 31, ],
            ['name' => 'MPhil. Mechanical Eng. (Design and Manufacturing) Top Up', 'department_id' => 31, ],
            ['name' => 'PhD. Mechanical Engineering', 'department_id' => 31, ],
            ['name' => 'PhD. Sustainable Energy Technologies', 'department_id' => 31, ],

            // Department of Materials Engineering 32
            ['name' => 'MPhil. Environmental Resources Management', 'department_id' => 32, ],
            ['name' => 'MPhil. Materials Engineering', 'department_id' => 32, ],
            ['name' => 'PhD. Materials Engineering', 'department_id' => 32, ],

            // COLLEGE OF HEALTH SCIENCES
            // FACULTY OF PHARMACY AND PHARMACEUTICAL SCIENCES 9
            // Programs without Department
            ['name' => '110 Bachelor of Herbal Medicine (BHM)', 'department_id' => null, ],
            ['name' => '981 Doctor of Pharmacy (Pharm D)', 'department_id' => null, ],
            ['name' => '1277 Doctor of Pharmacy (Pharm D)  | 2 years Top Up (Practicing Pharmacists only)', 'department_id' => null, ],

            // Department of Pharmaceutics 33
            ['name' => 'MSc. Pharmaceutical Technology', 'department_id' => 33, ],
            ['name' => 'MPhil. Pharmaceutics', 'department_id' => 33, ],
            ['name' => 'MPhil. Pharmaceutical Microbiology', 'department_id' => 33, ],
            ['name' => 'PhD. Pharmaceutics', 'department_id' => 33, ],
            ['name' => 'PhD. Pharmaceutical Microbiology', 'department_id' => 33, ],

            // Department of Pharmacognosy 34
            ['name' => 'MPhil. Pharmacognosy', 'department_id' => 34, ],
            ['name' => 'PhD. Pharmacognosy', 'department_id' => 34, ],

            // Department of Pharmaceutical Chemistry 35
            ['name' => 'MPhil. Pharmaceutical Chemistry', 'department_id' => 35, ],
            ['name' => 'PhD. Pharmaceutical Chemistry', 'department_id' => 35, ],

            // Department of Pharmacy Practice 36
            ['name' => 'MSc. Clinical Pharmacy (Part Time)', 'department_id' => 36, ],
            ['name' => 'MPhil. Clinical Pharmacy (Full Time)', 'department_id' => 36, ],
            ['name' => 'PhD. Clinical Pharmacy', 'department_id' => 36, ],
            ['name' => 'PhD. Social Pharmacy', 'department_id' => 36, ],
            ['name' => 'Department of Pharmacology', 'department_id' => 36, ],
            ['name' => 'MPhil Pharmacology', 'department_id' => 36, ],
            ['name' => 'MPhil Clinical Pharmacology', 'department_id' => 36, ],
            ['name' => 'PhD Pharmacology', 'department_id' => 36, ],
            ['name' => 'PhD Clinical Pharmacology', 'department_id' => 36, ],

            // FACULTY OF ALLIED HEALTH SCIENCES 10
            // Programs without department
            ['name' => '531 BSc. Nursing', 'department_id' => null, ],
            ['name' => '1483 BSc. Nursing (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '912 Nursing (Emergency Option for Practicing Nurses Only)', 'department_id' => null, ],
            ['name' => '952 BSc. Midwifery (Females only)', 'department_id' => null, ],
            ['name' => '418 BSc. Midwifery (Females practicing Midwives only) (Sandwich)', 'department_id' => null, ],
            ['name' => '1484 BSc. Midwifery (Obuasi Campus)', 'department_id' => null, ],
            ['name' => '1370 BSc. Physiotherapy and Sports Science', 'department_id' => null, ],
            ['name' => '1374 BSc. Medical Imaging', 'department_id' => null, ],
            ['name' => '106 BSc. Medical Laboratory Science', 'department_id' => null, ],
            ['name' => '1485 BSc. Medical Laboratory Science (Obuasi Campus)', 'department_id' => null, ],

            // Department of Nursing 37
            ['name' => 'MSc. Clinical Nursing', 'department_id' => 37, ],
            ['name' => 'MPhil. Nursing', 'department_id' => 37, ],

            // Department of Physiotherapy and Sports Science 38
            ['name' => 'MPhil. Clinical Rehabilitation and Exercise Therapy', 'department_id' => 38, ],

            // Department of Medical Diagnostics 39
            ['name' => 'MPhil. Haematology', 'department_id' => 39, ],
            ['name' => 'MPhil. Medical Imaging', 'department_id' => 39, ],
            ['name' => 'PhD. Haematology', 'department_id' => 39, ],
            ['name' => 'PhD. Medical Imaging', 'department_id' => 39, ],

            // SCHOOL OF MEDICINE AND DENTISTRY 11
            // Programs without Department
            ['name' => '105 Human Biology (Medicine) (MBChB)', 'department_id' => null, ],
            ['name' => '802 Bachelor of Dental Surgery (BDS) (Fee paying only)', 'department_id' => null, ],
            ['name' => '1371 BSc. Physician Assistantship', 'department_id' => null, ],

            // Department of Molecular Medicine 40
            ['name' => 'MPhil. Chemical Pathology', 'department_id' => 40, ],
            ['name' => 'MPhil. Molecular Medicine', 'department_id' => 40, ],
            ['name' => 'MPhil. Immunology', 'department_id' => 40, ],
            ['name' => 'PhD. Chemical Pathology', 'department_id' => 40, ],
            ['name' => 'PhD. Molecular Medicine', 'department_id' => 40, ],
            ['name' => 'PhD. Immunology', 'department_id' => 40, ],

            // Department of Clinical Microbiology 41
            ['name' => 'MPhil. Clinical Microbiology', 'department_id' => 41, ],
            ['name' => 'PhD. Clinical Microbiology', 'department_id' => 41, ],

            // Department of Anatomy 42
            ['name' => 'MPhil. Human Anatomy and Cell Biology', 'department_id' => 42, ],
            ['name' => 'MPhil. Human Anatomy and Cell Biology (Morphological Diagnostics)', 'department_id' => 42, ],
            ['name' => 'MPhil. Human Anatomy and Forensic Science', 'department_id' => 42, ],
            ['name' => 'MPhil. Mortuary Science and Management', 'department_id' => 42, ],
            ['name' => 'PhD. Human Anatomy and Cell Biology', 'department_id' => 42, ],
            ['name' => 'PhD. Human Anatomy and Forensic Science', 'department_id' => 42, ],

            // Department of Physiology 43
            ['name' => 'MPhil. Physiology', 'department_id' => 43, ],
            ['name' => 'MSc. Speech and Language Therapy', 'department_id' => 43, ],
            ['name' => 'MPhil. Comparative Anatomy', 'department_id' => 43, ],

            // SCHOOL OF VETERINARY MEDICINE  44
            ['name' => 'Master of Veterinary Science in Anatomy', 'department_id' => 44, ],
            ['name' => 'PhD. Integrative Pathobiology', 'department_id' => 44, ],
            ['name' => 'PhD. One Health', 'department_id' => 44, ],
            ['name' => 'PhD. Veterinary Anatomy', 'department_id' => 44, ],

            ['name' => '  882 Doctor of Veterinary Medicine (DVM)', 'department_id' => 44, ],
            // SCHOOL OF PUBLIC HEALTH   12
            // Programs Without Departments
            ['name' => '953 BSc. Disability and Rehabilitation Studies',],

            // Department Unknown
            ['name' => 'PhD. Public health',],

            // Department of Health Education, Promotion and Disability Studies  45
            ['name' => 'MPH/MSc. Health Education and Promotion (Regular/Weekend)', 'department_id' => 45, ],
            ['name' => 'MPhil. Disability, Rehabilitation and Development (Full Time/ Weekend)', 'department_id' => 45, ],

            // Department of Population, Family and Reproductive Health 46
            ['name' => 'MSc. Population and Reproductive Health (One Year   Full Time/ Weekend)', 'department_id' => 46, ],
            ['name' => 'MPH. Population and Reproductive Health (One Year   Full Time/ Weekend)', 'department_id' => 46, ],

            // Department of Occupational and Environmental Health and Safety 47
            ['name' => 'MSc. Occupational and Environmental Health & Safety (One Year   Full Time/ Weekend)', 'department_id' => 47, ],
            ['name' => 'MPH. Occupational and Environmental Health & Safety (One Year   Full Time/ Weekend)', 'department_id' => 47, ],

            // Department of Health Policy, Management and Economics 48
            ['name' => 'MSc. Health Services Planning and Management (One Year  | Regular/Weekend)', 'department_id' => 48, ],
            ['name' => 'MPH. Health Services Planning and Management (One Year  | Regular/Weekend)', 'department_id' => 48, ],
            ['name' => 'MSc. Health Systems Research and Management (Regular) iv. MPH. Health Systems Research and Management (Weekend)', 'department_id' => 48, ],
            ['name' => 'MPhil. Health Systems Research and Management (Regular/ Weekend', 'department_id' => 48, ],

            // Department of Epidemiology and Biostatistics 49
            ['name' => 'MPhil. Field Epidemiology and Applied Biostatistics', 'department_id' => 49, ],

            // Department of Global and International Health 50
            ['name' => 'MPH. Global Health (One Year)', 'department_id' => 50, ],

            // COLLEGE OF HUMANITIES AND SOCIAL SCIENCES
            // FACULTY OF LAW  13
            // No Known department
            ['name' => 'Master of Laws (LLM)'],
            ['name' => 'PhD Law',],

            ['name' => '532 Bachelor of Laws (LLB)'],
            ['name' => '747 LLB (Degree Holders Only) (Fee Paying)'],

            // FACULTY OF SOCIAL SCIENCES 14
            // Programs without departments
            ['name' => '795 BA. Economics',],
            ['name' => '794 BA. English',],
            ['name' => '793 BA. Geography and Rural Development',],
            ['name' => '894 BA. History',],
            ['name' => '791 BA. Political Studies',],
            ['name' => '1386 1BA. Akan Language and Culture',],
            ['name' => '1387 BA. French and Francophone Studies',],
            ['name' => '1388 BA. Linguistics',],
            ['name' => '1389 BA. Media and Communication Studies',],
            ['name' => '797 BA. Religious Studies',],
            ['name' => '977 BA. Sociology',],
            ['name' => '971 BA. Social Work',],

            // Department of Economics 51
            ['name' => 'MSc. Economics (One Year)', 'department_id' => 51, ],
            ['name' => 'MSc. Economics and Finance (One Year)', 'department_id' => 51, ],
            ['name' => '. MSc. Business Economics (One Year)', 'department_id' => 51, ],
            ['name' => 'MPhil. Economics', 'department_id' => 51, ],
            ['name' => 'PhD. Economics', 'department_id' => 51, ],

            // Department of Language and Communication Sciences 52
            ['name' => 'MPhil. French', 'department_id' => 52, ],
            ['name' => 'PhD. French', 'department_id' => 52, ],

            // Department of Geography and Rural Development 53
            ['name' => 'MSc. Geography and Sustainable Development (One Year)', 'department_id' => 53, ],
            ['name' => 'MPhil. Geography and Rural Development', 'department_id' => 53, ],
            ['name' => 'PhD. Geography and Rural Development', 'department_id' => 53, ],

            // Department of Religious Studies 54
            ['name' => 'MA. Religious Studies (One Year)', 'department_id' => 54, ],
            ['name' => 'MPhil. Religious Studies', 'department_id' => 54, ],
            ['name' => 'PhD. Religious Studies', 'department_id' => 54, ],

            // Department of Sociology and Social Work 55
            ['name' => 'MA. Sociology', 'department_id' => 55, ],
            ['name' => 'MPhil. Sociology', 'department_id' => 55, ],
            ['name' => 'MA. Social Work (One Year)', 'department_id' => 55, ],
            ['name' => 'MPhil. Social Work', 'department_id' => 55, ],
            ['name' => 'PhD. Sociology', 'department_id' => 55, ],

            // Department of History and Political Studies 56
            ['name' => 'MA. Chieftaincy and Traditional Leadership (One Year)', 'department_id' => 56, ],
            ['name' => 'Master of Public Administration (Full Time/Weekend)', 'department_id' => 56, ],
            ['name' => 'MA. Asante History (One Year)', 'department_id' => 56, ],
            ['name' => 'MPhil. Historical Studies', 'department_id' => 56, ],
            ['name' => 'MPhil. Political Science', 'department_id' => 56, ],
            ['name' => 'PhD. Historical Studies', 'department_id' => 56, ],

            // KNUST SCHOOL OF BUSINESS (KSB) 57
            ['name' => 'Master of Business Administration (MBA)   Regular/Evening/ Weekend', 'department_id' => 57, ],
            ['name' => 'Master of Science Programmes (Weekends Only)', 'department_id' => 57, ],
            ['name' => 'PhD. Organisational Leadership', 'department_id' => 57, ],
            ['name' => 'PhD. Business and Management', 'department_id' => 57, ],
            ['name' => 'MPhil. Management and Human Resource Strategy', 'department_id' => 57, ],
            ['name' => 'MPhil. Logistics and Supply Chain Management (Weekend Only)', 'department_id' => 57, ],
            ['name' => 'MPhil. Procurement and Supply Chain Management (Weekend Only)', 'department_id' => 57, ],
            ['name' => 'MPhil. Accounting', 'department_id' => 57, ],
            ['name' => 'MPhil. Finance', 'department_id' => 57, ],
            // UnderGraduate Programs
            ['name' => '1272 BSc. Business Administration(Human Resource Management /Management)', 'department_id' => 57, ],
            ['name' => '1431 BSc. Business Administration(Human Resource Management /Management) (Obuasi Campus)', 'department_id' => 57, ],
            ['name' => '1273 BSc. Business Administration(Marketing/International Business)', 'department_id' => 57, ],
            ['name' => '1433 BSc. Business Administration(Marketing/International Business)(Obuasi Campus)', 'department_id' => 57, ],
            ['name' => '1274 BSc. Business Administration(Accounting / Banking and Finance)', 'department_id' => 57, ],
            ['name' => '1432 BSc. Business Administration(Accounting / Banking and Finance)(Obuasi Campus)', 'department_id' => 57, ],
            ['name' => '1275 BSc. Business Administration(Logistics and Supply Chain Management/Business Information Technology)', 'department_id' => 57, ],
            ['name' => '1423 BSc. Business Administration(Logistics and Supply Chain Management/Business Information Technology) (Obuasi Campus)', 'department_id' => 57, ],
            ['name' => '191 BSc. Hospitality and Tourism Management', 'department_id' => 57, ],

            // COLLEGE OF SCIENCE
            // FACULTY OF BIOSCIENCES  15
            // Programs without Departments
            ['name' => '102 BSc. Biochemistry', 'department_id' => null, ],
            ['name' => '547 BSc. Food Science and Technology', 'department_id' => null, ],
            ['name' => '103 BSc. Biological Science', 'department_id' => null, ],
            ['name' => '548 BSc. Environmental Science', 'department_id' => null, ],
            ['name' => '1422 BSc. Environmental Science(Obuasi Campus)', 'department_id' => null, ],
            ['name' => '109 Doctor of Optometry', 'department_id' => null, ],

            // Department of Biochemistry and Biotechnology 58
            ['name' => 'MSc. Biotechnology', 'department_id' => 58, ],
            ['name' => 'MPhil. Biotechnology', 'department_id' => 58, ],
            ['name' => 'MPhil. Biochemistry', 'department_id' => 58, ],
            ['name' => 'MSc. Biodata Analytics and Computational Genomics', 'department_id' => 58, ],
            ['name' => 'MPhil. Biodata Analytics and Computational Genomics', 'department_id' => 58, ],
            ['name' => 'MSc. Forensic Science', 'department_id' => 58, ],
            ['name' => 'MPhil. Forensic Science', 'department_id' => 58, ],
            ['name' => 'MPhil. Human Nutrition and Dietetics', 'department_id' => 58, ],
            ['name' => 'PhD. Biotechnology', 'department_id' => 58, ],
            ['name' => 'PhD. Biochemistry', 'department_id' => 58, ],
            ['name' => 'PhD. Human Nutrition and Dietetics', 'department_id' => 58, ],
            ['name' => 'PhD. Biodata Analytics and Computational Genomics', 'department_id' => 58, ],

            // Department of Food Science and Technology 59
            ['name' => 'MSc. Food Quality Management', 'department_id' => 59, ],
            ['name' => 'MSc. Food Science and Technology', 'department_id' => 59, ],
            ['name' => 'MPhil. Food Science and Technology', 'department_id' => 59, ],
            ['name' => 'PhD Food Science and Technology', 'department_id' => 59, ],

            // Department of Environmental Science 60
            ['name' => 'MPhil. Environmental Science', 'department_id' => 60, ],
            ['name' => 'MPhil. Environmental Science (Top Up)', 'department_id' => 60, ],
            ['name' => 'PhD. Environmental Science', 'department_id' => 60, ],

            // Department of Theoretical and Applied Biology 61
            ['name' => 'MPhil. Parasitology', 'department_id' => 61, ],
            ['name' => 'MPhil. Ecology', 'department_id' => 61, ],
            ['name' => 'MPhil. Entomology', 'department_id' => 61, ],
            ['name' => 'MPhil. Plant Physiology', 'department_id' => 61, ],
            ['name' => 'MPhil. Microbiology', 'department_id' => 61, ],
            ['name' => 'MPhil. Plant Pathology', 'department_id' => 61, ],
            ['name' => 'MPhil. Reproductive Biology', 'department_id' => 61, ],
            ['name' => 'PhD. Parasitology', 'department_id' => 61, ],
            ['name' => 'PhD. Ecology', 'department_id' => 61, ],
            ['name' => 'PhD. Entomology', 'department_id' => 61, ],
            ['name' => 'PhD. Animal Physiology', 'department_id' => 61, ],
            ['name' => 'PhD. Limnology and Fisheries', 'department_id' => 61, ],
            ['name' => 'PhD. Plant Physiology', 'department_id' => 61, ],
            ['name' => 'PhD. Microbiology', 'department_id' => 61, ],
            ['name' => 'PhD. Plant Pathology', 'department_id' => 61, ],
            ['name' => 'PhD. Reproductive Biology', 'department_id' => 61, ],

            // Department of Optometry and Visual Science  62
            ['name' => 'MPhil Vision Science', 'department_id' => 62, ],
            ['name' => 'PhD Vision Science', 'department_id' => 62, ],

            // FACULTY OF PHYSICAL & COMPUTATIONAL SCIENCES 16
            // Programs with no department
            ['name' => '104 BSc. Chemistry',],
            ['name' => '202 BSc. Mathematics',],
            ['name' => '201 BSc. Physics',],
            ['name' => '203 BSc. Computer Science',],
            ['name' => '951 BSc. Statistics',],
            ['name' => '750 BSc. Actuarial Science',],
            ['name' => '876 BSc. Meteorology and Climate Science',],

            // Department of Chemistry 63
            ['name' => 'MPhil. Chemistry', 'department_id' => 63, ],
            ['name' => 'MPhil. Organic and Natural Products', 'department_id' => 63, ],
            ['name' => 'MPhil. Analytical Chemistry', 'department_id' => 63, ],
            ['name' => 'MPhil. Environmental Chemistry', 'department_id' => 63, ],
            ['name' => 'MPhil. Physical Chemistry', 'department_id' => 63, ],
            ['name' => 'MPhil. Polymer Science and Technology', 'department_id' => 63, ],
            ['name' => 'PhD. Chemistry', 'department_id' => 63, ],

            // Department of Physics 64
            ['name' => 'MPhil. Geophysics', 'department_id' => 64, ],
            ['name' => 'MPhil. Environmental Physics', 'department_id' => 64, ],
            ['name' => 'MPhil. Solid State Physics', 'department_id' => 64, ],
            ['name' => 'MPhil. Materials Science', 'department_id' => 64, ],
            ['name' => 'MPhil. Nuclear Science and Technology', 'department_id' => 64, ],
            ['name' => 'MPhil. Mathematical and Computational Physics', 'department_id' => 64, ],
            ['name' => 'PhD. Geophysics', 'department_id' => 64, ],
            ['name' => 'PhD. Environmental Physics', 'department_id' => 64, ],
            ['name' => 'PhD. Solid State Physics', 'department_id' => 64, ],
            ['name' => 'PhD. Materials Science', 'department_id' => 64, ],
            ['name' => 'PhD. Materials Science', 'department_id' => 64, ],
            ['name' => 'PhD. Nuclear Science and Technology', 'department_id' => 64, ],
            ['name' => 'PhD. Mathematical and Computational Physics', 'department_id' => 64, ],

            // Department of Meteorology and Climate Science 65
            ['name' => 'MPhil. Meteorology and Climate Science', 'department_id' => 65, ],
            ['name' => 'PhD. Meteorology and Climate Science', 'department_id' => 65, ],

            // Department of Mathematics 66
            ['name' => 'MPhil. Pure Mathematics', 'department_id' => 66, ],
            ['name' => 'MPhil. Applied Mathematics', 'department_id' => 66, ],
            ['name' => 'MPhil. Scientific Computing and Industrial Modeling', 'department_id' => 66, ],
            ['name' => 'PhD. Scientific Computing and Industrial Modeling', 'department_id' => 66, ],
            ['name' => 'PhD. Pure Mathematics', 'department_id' => 66, ],
            ['name' => 'PhD. Applied Mathematics', 'department_id' => 66, ],
            ['name' => 'PhD. Pure Mathematics', 'department_id' => 66, ],

            // Department of Statistics and Actuarial Science 67
            ['name' => 'MPhil. Actuarial Science', 'department_id' => 67, ],
            ['name' => 'MPhil. Mathematical Statistics', 'department_id' => 67, ],
            ['name' => 'PhD Actuarial Science', 'department_id' => 67, ],
            ['name' => 'PhD Mathematical Statistics', 'department_id' => 67, ],

            // Department of Computer Science 68
            ['name' => 'MSc. Computer Science', 'department_id' => 68, ],
            ['name' => 'MPhil. Computer Science', 'department_id' => 68, ],
            ['name' => 'MSc. Cyber Security and Digital Forensics', 'department_id' => 68, ],
            ['name' => 'MPhil. Cyber Security and Digital Forensics', 'department_id' => 68, ],
            ['name' => 'MSc. Information Technology', 'department_id' => 68, ],
            ['name' => 'MPhil. Information Technology', 'department_id' => 68, ],
            ['name' => 'PhD. Computer Science', 'department_id' => 68, ],
            ['name' => 'PhD. Information Technology', 'department_id' => 68, ],

            // INSTITUTE OF DISTANCE LEARNING 69
            ['name' => 'MSc. Health Informatics', 'department_id' => 69, ],
            ['name' => 'MSc. Information Technology', 'department_id' => 69, ],
            ['name' => 'MSc. Human Nutrition', 'department_id' => 69, ],
            ['name' => 'MSc. Food Quality Management', 'department_id' => 69, ],
            ['name' => 'MSc. Biotechnology', 'department_id' => 69, ],
            ['name' => 'MSc. Forensic Science', 'department_id' => 69, ],
            ['name' => 'Commonwealth Master of Business Administration (CMBA)', 'department_id' => 69, ],
            ['name' => 'MBA International Business', 'department_id' => 69, ],
            ['name' => 'MSc. Planning, Monitoring and Evaluation', 'department_id' => 69, ],
            ['name' => 'MSc. Industrial Finance and Investment', 'department_id' => 69, ],
            ['name' => 'MSc. Business Consulting and Enterprise Risk Management', 'department_id' => 69, ],
            ['name' => 'MSc. Educational Innovations and Leadership Science', 'department_id' => 69, ],
            ['name' => 'Master of Education (M.Ed)', 'department_id' => 69, ],
            ['name' => 'MSc. Project Management (available at the Accra and Takoradi Centres only) ,', 'department_id' => 69, ],
            ['name' => 'MSc. Development Management', 'department_id' => 69, ],
            ['name' => 'Master of Public Administration (MPA)', 'department_id' => 69, ],
            ['name' => 'MSc. Security and Justice Administration', 'department_id' => 69, ],
            ['name' => 'MSc. Energy and Sustainable Management', 'department_id' => 69, ],
            ['name' => 'MSc. Hospitality and Tourism Management', 'department_id' => 69, ],
            ['name' => 'MSc. Strategic Management and Leadership', 'department_id' => 69, ],
            ['name' => 'MSc. Corporate Governance and Strategic Leadership', 'department_id' => 69, ],
            ['name' => 'MSc. Insurance and Business Continuity', 'department_id' => 69, ],
            ['name' => 'MSc. Development Finance', 'department_id' => 69, ],
            ['name' => 'MSc. Management and Human Resource Strategy', 'department_id' => 69, ],
            ['name' => 'MSc. Marketing', 'department_id' => 69, ],
            ['name' => 'MSc. Economics (available at the Accra Centre only)', 'department_id' => 69, ],
            ['name' => 'MPhil. Post Harvest Technology (Horticulture)', 'department_id' => 69, ],
            ['name' => 'MSc. Logistics and Supply Chain Management', 'department_id' => 69, ],
            ['name' => 'MSc. Procurement and Supply Chain Management', 'department_id' => 69, ],
            ['name' => 'MSc. Geography and Sustainable Development', 'department_id' => 69, ],
            ['name' => 'MSc. Accounting and Finance', 'department_id' => 69, ],
            ['name' => 'MSc. Actuarial Science', 'department_id' => 69, ],
            ['name' => 'MSc. Applied Statistics', 'department_id' => 69, ],
            ['name' => 'MSc. Environmental Science', 'department_id' => 69, ],
            ['name' => 'MSc. Agribusiness Management', 'department_id' => 69, ],
            ['name' => 'MSc. Mechanical Engineering', 'department_id' => 69, ],
            ['name' => 'MSc. Cyber Security and Digital Forensics', 'department_id' => 69, ],
            ['name' => 'MSc. Environmental Resources Management', 'department_id' => 69, ],
            ['name' => 'MSc. Communication System and Network Engineering', 'department_id' => 69, ],
            ['name' => 'Professional Master of Engineering with Management (MEng) Programmes', 'department_id' => 69, ],
            ['name' => 'MPhil. Crop Science', 'department_id' => 69, ],
            ['name' => 'MSc. Agricultural Extension and Development Communication', 'department_id' => 69, ],
            ['name' => 'MSc Physics', 'department_id' => 69, ],

        ];
        // Program::factory(150)->create();

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
