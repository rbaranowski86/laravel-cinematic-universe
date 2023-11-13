import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { TextField, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper } from '@mui/material';
import { fetchMovieDetails, fetchCharactersByMovie } from '../services/UniverseService';
import { Movie, Character } from '../types';

const MoviePage: React.FC = () => {
    const { movieId } = useParams<{ movieId: string }>();
    const [movie, setMovie] = useState<Movie | null>(null);
    const [characters, setCharacters] = useState<Character[]>([]);
    const [searchTerm, setSearchTerm] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        if (movieId) {
            const id = parseInt(movieId);
            fetchMovieDetails(id).then(movieData => {
                setMovie(movieData);
                setLoading(false);
            }).catch(err => {
                console.error(`Error while fetching details for movie ${id}:`, err);
                setError('Failed to load movie details');
                setLoading(false);
            });

            fetchCharacters(id, '');
        }
    }, [movieId]);

    const fetchCharacters = (id, searchTerm) => {
        fetchCharactersByMovie(id, searchTerm).then(charactersData => {
            setCharacters(charactersData);
        }).catch(err => {
            console.error(`Error while fetching characters for movie ${id}:`, err);
        });
    };

    const handleSearchChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const handleSearch = () => {
        fetchCharacters(parseInt(movieId), searchTerm);
    };

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;
    if (!movie) return <div>Movie not found</div>;

    return (
        <div>
            <h1>{movie.title}</h1>
            <p><strong>Release Date:</strong> {movie.releaseDate}</p>
            <p><strong>Director:</strong> {movie.director}</p>
            <p><strong>Box Office Earnings:</strong> ${movie.boxOfficeEarnings.toLocaleString()}</p>

            <h2>Characters</h2>
            <TextField
                label="Search Characters"
                variant="outlined"
                value={searchTerm}
                onChange={handleSearchChange}
                onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
            />
            <TableContainer component={Paper}>
                <Table aria-label="simple table">
                    <TableHead>
                        <TableRow>
                            <TableCell>Name</TableCell>
                            <TableCell>Alias</TableCell>
                            <TableCell>Superpowers</TableCell>
                            <TableCell>First Appearance</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {characters.map((character) => (
                            <TableRow key={character.id}>
                                <TableCell>{character.name}</TableCell>
                                <TableCell>{character.alias || 'N/A'}</TableCell>
                                <TableCell>{character.superpowers || 'N/A'}</TableCell>
                                <TableCell>{character.firstAppearance || 'N/A'}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </div>
    );
};

export default MoviePage;
