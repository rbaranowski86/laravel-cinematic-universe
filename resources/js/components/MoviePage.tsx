import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { fetchMovieDetails, fetchCharactersByMovie } from '../services/UniverseService';
import { Movie, Character } from '../types';

const MoviePage: React.FC = () => {
    const { movieId } = useParams<{ movieId: string }>();
    const [movie, setMovie] = useState<Movie | null>(null);
    const [characters, setCharacters] = useState<Character[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        if (movieId) {
            const id = parseInt(movieId);
            fetchMovieDetails(id)
                .then(movieData => {
                    setMovie(movieData);
                    setLoading(false);
                })
                .catch(err => {
                    console.error(`Error while fetching details for movie ${id}:`, err);
                    setError('Failed to load movie details');
                    setLoading(false);
                });

            fetchCharactersByMovie(id)
                .then(charactersData => {
                    setCharacters(charactersData);
                })
                .catch(err => {
                    console.error(`Error while fetching characters for movie ${id}:`, err);
                });
        }
    }, [movieId]);

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
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Alias</th>
                    <th>Superpowers</th>
                    <th>First Appearance</th>
                </tr>
                </thead>
                <tbody>
                {characters.map(character => (
                    <tr key={character.id}>
                        <td>{character.name}</td>
                        <td>{character.alias || 'N/A'}</td>
                        <td>{character.superpowers || 'N/A'}</td>
                        <td>{character.firstAppearance || 'N/A'}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default MoviePage;
