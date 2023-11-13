import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { TextField } from '@mui/material';
import { fetchMoviesByUniverse, fetchUniverseDetails } from '../services/UniverseService';
import { Movie, CinematicUniverse } from '../types';
import Timeline from '@mui/lab/Timeline';
import TimelineItem from '@mui/lab/TimelineItem';
import TimelineSeparator from '@mui/lab/TimelineSeparator';
import TimelineDot from '@mui/lab/TimelineDot';
import TimelineConnector from '@mui/lab/TimelineConnector';
import TimelineContent from '@mui/lab/TimelineContent';

const UniversePage: React.FC = () => {
    const { id } = useParams<{ id: string }>();
    const [universe, setUniverse] = useState<CinematicUniverse | null>(null);
    const [movies, setMovies] = useState<Movie[]>([]);
    const [filter, setFilter] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        if (id) {
            const universeId = parseInt(id);
            Promise.all([
                fetchUniverseDetails(universeId),
                fetchMoviesByUniverse(universeId)
            ]).then(([universeResponse, moviesResponse]) => {
                setUniverse(universeResponse);
                setMovies(moviesResponse);
                setLoading(false);
            }).catch(err => {
                console.error('Error:', err);
                setError('Failed to load data');
                setLoading(false);
            });
        }
    }, [id]);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    const handleFilterChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilter(event.target.value.toLowerCase());
    };

    const filteredMovies = movies.filter(movie =>
        movie.title.toLowerCase().includes(filter)
    ).sort((a, b) => b.releaseDate.localeCompare(a.releaseDate));

    return (
        <div>
            <h1>{universe?.name}</h1>
            <p>{universe?.description}</p>
            {/* Additional details about the universe can go here */}
            <TextField
                label="Filter Movies"
                variant="outlined"
                value={filter}
                onChange={handleFilterChange}
                style={{ marginBottom: '20px' }}
            />
            <h2>Movies Timeline</h2>
            <Timeline>
                {filteredMovies.map((movie) => (
                    <TimelineItem key={movie.id}>
                        <TimelineSeparator>
                            <TimelineDot />
                            <TimelineConnector />
                        </TimelineSeparator>
                        <TimelineContent>
                            <Link to={`/movie/${movie.id}`}>
                                <h3>{movie.title}</h3>
                            </Link>
                            <p>Release Date: {movie.releaseDate}</p>
                        </TimelineContent>
                    </TimelineItem>
                ))}
            </Timeline>
        </div>
    );
};

export default UniversePage;
